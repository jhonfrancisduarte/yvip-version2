<?php

namespace App\Filament\Resources\UserDataResource\Pages;

use App\Filament\Resources\UserDataResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\src\ExportPdfAction;

class ViewUserData extends ViewRecord
{
    protected static string $resource = UserDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
            Actions\ExportPdfAction::make(),
        ];
    }
}
