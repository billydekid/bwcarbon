<?php

namespace App\Filament\Resources\EntryMeasurementResource\Pages;

use App\Filament\Resources\EntryMeasurementResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEntryMeasurements extends ManageRecords
{
    protected static string $resource = EntryMeasurementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
