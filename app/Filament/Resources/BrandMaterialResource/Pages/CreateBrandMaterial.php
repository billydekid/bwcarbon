<?php

namespace App\Filament\Resources\BrandMaterialResource\Pages;

use App\Filament\Resources\BrandMaterialResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBrandMaterial extends CreateRecord
{
    protected static string $resource = BrandMaterialResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
