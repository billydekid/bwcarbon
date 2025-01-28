<?php

namespace App\Filament\Resources\InventorySvac11Resource\Pages;

use App\Filament\Resources\InventorySvac11Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventorySvac11s extends ListRecords
{
    protected static string $resource = InventorySvac11Resource::class;

    protected static ?string $title = 'Fuels Consumption';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New fuels consumption'),
        ];
    }
}
