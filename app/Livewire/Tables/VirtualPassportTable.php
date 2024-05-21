<?php

namespace App\Livewire\Tables;

use Carbon\Carbon;
use App\Models\User;
use App\Models\IpEvents;
use App\Models\VolunteerEventsAndTrainings;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;


class VirtualPassportTable extends Component
{
    use WithPagination;

    public $qrCodeUrl;
    public $search;
    public $totalVolunteeringHours;
    public $myEvents = [];
    public $generatingPdf = false;

    public function mount()
    {
        $this->generateQrCodeUrl();
        $this->totalVolunteeringHours = $this->getTotalVolunteeringHours();

    }

    private function getTotalVolunteeringHours() {
        $user = Auth::user();
        $rewardClaim = $user->rewardClaim;

        if ($rewardClaim && $rewardClaim->total_hours) {
            return $rewardClaim->total_hours;
        } else {
            return 0;
        }
    }


    private function getUserIpEvents()
    {
        $userId = Auth::id();
        return IpEvents::whereRaw('find_in_set(?, participants)', [$userId])->get();
    }

    public function generateQrCodeUrl()
    {
        $userData = Auth::user()->userData;
        $totalVolunteeringHours = $this->getTotalVolunteeringHours();
        $details = [
            'Passport No.: ' . $userData->passport_number,
            'Name: ' . $userData->first_name . ' ' . $userData->last_name,
            'Nationality: ' . $userData->nationality,
            'Sex: ' . $userData->sex,
            'Address: ' . $userData->p_street_barangay . ', ' . $userData->permanent_selectedCity . ', ' . $userData->permanent_selectedProvince,
            'Date of Birth: ' . $userData->date_of_birth,
            'Total Volunteering Hours: ' . $totalVolunteeringHours . ' hrs',
        ];

        // Add user's volunteer events and trainings
        $userId = Auth::id();
        $volunteerEventsAndTrainings = VolunteerEventsAndTrainings::join('users', 'users.id', '=', 'volunteer_events_and_trainings.user_id')
            ->select('users.name', 'volunteer_events_and_trainings.*', 'volunteer_events_and_trainings.start_date', 'volunteer_events_and_trainings.end_date')
            ->whereRaw('find_in_set(?, volunteer_events_and_trainings.participants)', [$userId])
            ->orderBy('volunteer_events_and_trainings.created_at', 'desc')
            ->get();
        $details[] = '';
        $details[] = 'My Youth Volunteer Events:';
        $details[] = 'No.|EventName|Category|Start Date|End Date|Hours'; // Header for volunteer events

        $eventNumber = 1;
        foreach ($volunteerEventsAndTrainings as $event) {
            $details[] = $eventNumber . ' - ' . implode(' - ', [
                $event->event_name,
                $event->event_type,
                Carbon::parse($event->start_date)->format('Y-m-d'), // Adjusted column name
                Carbon::parse($event->end_date)->format('Y-m-d'),   // Adjusted column name
                $event->volunteer_hours . ' hrs',
            ]);
            $eventNumber++;
        }

        // Add user's IP events
        $userIpEvents = $this->getUserIpEvents();
        $details[] = '';
        $details[] = 'My IP Events:';
        $details[] = 'No.|EventName|Sponsor|Start Date|End Date'; // Header for IP events

        $eventNumber = 1;
        foreach ($userIpEvents as $event) {
            $details[] = $eventNumber . ' - ' . implode(' - ', [
                $event->event_name,
                $event->organizer_sponsor,
                Carbon::parse($event->start)->format('Y-m-d'),
                Carbon::parse($event->end)->format('Y-m-d'),
            ]);
            $eventNumber++;
        }

        // Combine all details into QR code data
        $qrData = implode("\n", $details);


        $this->qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=' . urlencode($qrData);
    }




    public function render()
    {
        $userIpEvents = $this->getUserIpEvents();

        $ipEvents = IpEvents::join('users', 'users.id', '=', 'ip_events.user_id')
            ->select('users.name', 'ip_events.*')
            ->orderBy('ip_events.created_at', 'desc')
            ->paginate(10);

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

            $event->participantData = $participantData;
            $event->qualifications = explode(',', $event->qualifications);
            $event->approved = in_array($userId, $participantIds);

            return $event;
        });

        $volunteerEventsAndTrainings = VolunteerEventsAndTrainings::join('users', 'users.id', '=', 'volunteer_events_and_trainings.user_id')
            ->select('users.name', 'volunteer_events_and_trainings.*', 'volunteer_events_and_trainings.start_date', 'volunteer_events_and_trainings.end_date')
            ->search(trim($this->search))
            ->orderBy('volunteer_events_and_trainings.created_at', 'desc')
            ->paginate(10);

        $volunteerEventsAndTrainings->transform(function ($yvevent) {
            $participantIds = explode(',', $yvevent->participants);
            $userId = auth()->user()->id;

            $yvevent->approved = in_array($userId, $participantIds);

            return $yvevent;
        });

        return view('livewire.tables.virtual-passport-table', [
            'ipEvents' => $ipEvents,
            'qrCodeUrl' => $this->qrCodeUrl,
            'totalVolunteeringHours' => $this->totalVolunteeringHours,
            'volunteerEventsAndTrainings' => $volunteerEventsAndTrainings,
        ]);
    }




    public function generatePdf()
    {
        $this->generatingPdf = true;

        $ipEvents = $this->getUserIpEvents();
        $profilePictureUrl = Auth::user()->userData->profile_picture ?? 'default-profile-picture.png';
        $totalVolunteeringHours = $this->getTotalVolunteeringHours() ?? 0;

        $userId = Auth::id();
        $volunteerEventsAndTrainings = VolunteerEventsAndTrainings::join('users', 'users.id', '=', 'volunteer_events_and_trainings.user_id')
            ->select('users.name', 'volunteer_events_and_trainings.*', 'volunteer_events_and_trainings.start_date', 'volunteer_events_and_trainings.end_date')
            ->whereRaw('find_in_set(?, volunteer_events_and_trainings.participants)', [$userId])
            ->orderBy('volunteer_events_and_trainings.created_at', 'desc')
            ->get();

        if ($ipEvents->isEmpty()) {
            $ipEvents = collect([(object)[
                'event_name' => 'None',
                'organizer_sponsor' => 'None',
                'start' => 'None',
                'end' => 'None',
                'status' => 'None',
            ]]);
        }

        if ($volunteerEventsAndTrainings->isEmpty()) {
            $volunteerEventsAndTrainings = collect([(object)[
                'event_name' => 'None',
                'volunteer_category' => 'None',
                'start_date' => 'None',
                'end_date' => 'None',
                'volunteer_hours' => 0,
                'status' => 'None',
            ]]);
        }

        $pdf = PDF::loadView('pdf.passport-pdf', [
            'ipEvents' => $ipEvents,
            'qrCodeUrl' => $this->qrCodeUrl,
            'profilePictureUrl' => $profilePictureUrl,
            'totalVolunteeringHours' => $totalVolunteeringHours,
            'volunteerEventsAndTrainings' => $volunteerEventsAndTrainings,
        ]);

        $pdf->save(public_path('passport.pdf'));

        $this->generatingPdf = false;

        return response()->download(public_path('passport.pdf'));
    }





}
