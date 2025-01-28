<?php

namespace App\Filament\Resources\EntryUnitResource\Pages;

use App\Filament\Resources\EntryUnitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEntryUnit extends EditRecord
{
    protected static string $resource = EntryUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
