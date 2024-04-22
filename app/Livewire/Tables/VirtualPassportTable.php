<?php

namespace App\Livewire\Tables;

use BaconQrCode\Encoder\Encoder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VirtualPassportTable extends Component
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
            'Date of Birth' => $userData->date_of_birth,
        ];

        $text = '';
        foreach ($details as $key => $value) {
            $text .= "$key: $value\n";
        }

        $this->qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=' . urlencode($text);
    }

    public function render()
    {
        return view('livewire.tables.virtual-passport-table', [
            'qrCodeUrl' => $this->qrCodeUrl,
        ]);
    }
}
