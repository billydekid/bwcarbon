<?php

namespace App\Filament\Resources\BrandMaterialResource\Pages;

use App\Filament\Resources\BrandMaterialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBrandMaterial extends EditRecord
{
    protected static string $resource = BrandMaterialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
