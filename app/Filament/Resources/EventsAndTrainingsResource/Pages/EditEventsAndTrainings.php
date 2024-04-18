<?php

namespace App\Filament\Resources\EventsAndTrainingsResource\Pages;

use App\Filament\Resources\EventsAndTrainingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEventsAndTrainings extends EditRecord
{
    protected static string $resource = EventsAndTrainingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
