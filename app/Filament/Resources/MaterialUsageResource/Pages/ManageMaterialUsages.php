<?php

namespace App\Filament\Resources\MaterialUsageResource\Pages;

use App\Filament\Resources\MaterialUsageResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMaterialUsages extends ManageRecords
{
    protected static string $resource = MaterialUsageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
