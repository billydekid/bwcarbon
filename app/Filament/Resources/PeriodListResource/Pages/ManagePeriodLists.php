<?php

namespace App\Filament\Resources\PeriodListResource\Pages;

use App\Filament\Resources\PeriodListResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePeriodLists extends ManageRecords
{
    protected static string $resource = PeriodListResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
