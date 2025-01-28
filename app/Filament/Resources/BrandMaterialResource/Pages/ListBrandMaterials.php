<?php

namespace App\Filament\Resources\BrandMaterialResource\Pages;

use App\Filament\Resources\BrandMaterialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBrandMaterials extends ListRecords
{
    protected static string $resource = BrandMaterialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
