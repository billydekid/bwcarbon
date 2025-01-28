<?php

namespace App\Filament\Resources\EntryPeriodResource\Pages;

use App\Filament\Resources\EntryPeriodResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEntryPeriods extends ManageRecords
{
    protected static string $resource = EntryPeriodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
