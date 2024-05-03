<?php

namespace App\Filament\Resources\EventsAndTrainingsResource\Pages;

use App\Filament\Resources\EventsAndTrainingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEventsAndTrainings extends ListRecords
{
    protected static string $resource = EventsAndTrainingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
