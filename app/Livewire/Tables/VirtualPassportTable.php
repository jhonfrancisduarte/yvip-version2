<?php

namespace App\Livewire\Tables;

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
            'Address' => $userData->p_street_barangay . ', ' . $userData->permanent_selectedCity . ', ' . $userData->permanent_selectedProvince,
            'Date of Birth' => $userData->date_of_birth,
        ];

        // Construct the QR code data manually with newline characters
        $qrData = '';
        foreach ($details as $key => $value) {
            $qrData .= urlencode($key . ': ' . $value . "\n");
        }

        // Generate QR code URL using QR Code API
        $this->qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=400x400&data=' . $qrData;
    }

    public function render()
    {
        return view('livewire.tables.virtual-passport-table', [
            'qrCodeUrl' => $this->qrCodeUrl,
        ]);
    }
}
