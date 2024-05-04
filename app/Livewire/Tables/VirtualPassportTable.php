<?php

namespace App\Livewire\Tables;

use Carbon\Carbon;
use App\Models\User;
use App\Models\IpEvents;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class VirtualPassportTable extends Component
{
    use WithPagination;

    public $qrCodeUrl;
    public $search;
    public $myEvents = [];

    public function mount()
    {
        $this->generateQrCodeUrl();
    }

    private function getUserIpEvents()
    {
        $userId = Auth::id();
        return IpEvents::whereRaw('find_in_set(?, participants)', [$userId])->get();
    }

    public function generateQrCodeUrl()
    {
        $userData = Auth::user()->userData;
        $details = [
            'Passport No.: ' . $userData->passport_number,
            'Name: ' . $userData->first_name . ' ' . $userData->last_name,
            'Nationality: ' . $userData->nationality,
            'Sex: ' . $userData->sex,
            'Address: ' . $userData->p_street_barangay . ', ' . $userData->permanent_selectedCity . ', ' . $userData->permanent_selectedProvince,
            'Date of Birth: ' . $userData->date_of_birth,
            'My IP Events:',
            'EventName|Sponsor|Start Date|End Date',
        ];

        $userIpEvents = $this->getUserIpEvents();

        foreach ($userIpEvents as $event) {
            $details[] = implode(' | ', [
                $event->event_name,
                $event->organizer_sponsor,
                Carbon::parse($event->start)->format('Y-m-d'),
                Carbon::parse($event->end)->format('Y-m-d'),
            ]);
        }

        $qrData = implode("\n", $details);

        $this->qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=' . urlencode($qrData);
    }

    public function render()
    {
        $userIpEvents = $this->getUserIpEvents();

        $ipEvents = IpEvents::join('users', 'users.id', '=', 'ip_events.user_id')
            ->select('users.name', 'ip_events.*')
            ->orderBy('ip_events.created_at', 'desc')
            ->paginate(5); // Adjust the number of items per page as needed

        $ipEvents->transform(function ($event) use ($userIpEvents) {
            $participantIds = explode(',', $event->participants);
            $participantData = [];
            $userId = auth()->user()->id;

            foreach ($participantIds as $participantId) {
                $participantId = trim($participantId);

                if (!empty($participantId)) {
                    $user = User::find($participantId);
                    $userData = $user->userData;

                    if ($userData) {
                        $name = trim($userData->first_name . ' ' . $userData->middle_name . ' ' . $userData->last_name);
                        $participantData[] = [
                            'user_id' => $participantId,
                            'name' => $name,
                        ];
                    }
                }
            }
            $currentDate = now();
            if ($currentDate >= $event->start && $currentDate <= $event->end) {
                $event->status = 'Ongoing';
            } elseif ($currentDate > $event->end) {
                $event->status = 'Completed';
            } else {
                $event->status = 'Upcoming';
            }

            $event->participantData = $participantData;
            $event->qualifications = explode(',', $event->qualifications);
            $event->approved = in_array($userId, $participantIds);

            return $event;
        });

        return view('livewire.tables.virtual-passport-table', compact('ipEvents'), [
            'qrCodeUrl' => $this->qrCodeUrl,
        ]);
    }

    public function generatePdf()
{


    // Fetch all IP events
    $ipEvents = IpEvents::join('users', 'users.id', '=', 'ip_events.user_id')
        ->select('users.name', 'ip_events.*')
        ->orderBy('ip_events.created_at', 'desc')
        ->get();

    // Create PDF using Laravel DomPDF
    $pdf = PDF::loadView('pdf.passport-pdf', [
        'ipEvents' => $ipEvents,
        'qrCodeUrl' => $this->qrCodeUrl, // Pass the QR code URL to the PDF view
    ]);

    // Save the PDF file
    $pdf->save(public_path('passport.pdf'));

    // Download the PDF
    return response()->download(public_path('passport.pdf'));
}

}
