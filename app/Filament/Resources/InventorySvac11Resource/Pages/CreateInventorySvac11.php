<?php

namespace App\Filament\Resources\InventorySvac11Resource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Log;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\InventorySvac11Resource;

class CreateInventorySvac11 extends CreateRecord
{
    protected static string $resource = InventorySvac11Resource::class;

    protected static ?string $title = 'Create Fuels Consumption';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
