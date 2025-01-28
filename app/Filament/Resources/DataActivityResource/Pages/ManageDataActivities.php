<?php

namespace App\Filament\Resources\DataActivityResource\Pages;

use App\Filament\Resources\DataActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDataActivities extends ManageRecords
{
    protected static string $resource = DataActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
