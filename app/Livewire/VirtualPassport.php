<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VirtualPassport extends Component
{
    public $qrCodeUrl;

    public function mount()
    {
        $this->generateQrCodeUrl();
    }

    public function generateQrCodeUrl()
    {
        $userData = Auth::user()->userData;
        $details = [
            'Passport No.' => $userData->passport_number,
            'Name' => $userData->first_name . ' ' . $userData->last_name,
            'Nationality' => $userData->nationality,
            'Sex' => $userData->sex,
            'Date of Birth' => $userData->date_of_birth,
        ];

        // Generate QR code URL using QR Code API
        $queryString = http_build_query($details);
        $this->qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=' . urlencode($queryString);
    }

    public function render()
    {
        return view('livewire.virtual-passport', [
            'qrCodeUrl' => $this->qrCodeUrl,
        ]);
    }
}
