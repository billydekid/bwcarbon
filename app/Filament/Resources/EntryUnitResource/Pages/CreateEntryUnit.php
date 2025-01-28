<?php

namespace App\Filament\Resources\EntryUnitResource\Pages;

use App\Filament\Resources\EntryUnitResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEntryUnit extends CreateRecord
{
    protected static string $resource = EntryUnitResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
