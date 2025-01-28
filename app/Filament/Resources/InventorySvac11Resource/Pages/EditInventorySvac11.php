<?php

namespace App\Filament\Resources\InventorySvac11Resource\Pages;

use App\Filament\Resources\InventorySvac11Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventorySvac11 extends EditRecord
{
    protected static string $resource = InventorySvac11Resource::class;

    protected static ?string $title = 'Edit Fuel Consumptions';

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

    /**
     *  Mutate the form data before filling the form (EDIT & VIEW modes)
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Query related code values
        $materialUsageCodes = \App\Models\Svac11Fuels::where('inventory_svac11_id', $data['id'] ?? null)
            ->get()
            ->pluck('materialUsage.code')
            ->toArray();

        // Determine the value of is_total
        if (in_array('MOBILE-FUELS', $materialUsageCodes) && in_array('STATIONARY-FUELS', $materialUsageCodes)) {
            $data['is_total'] = true; // Checked
        } elseif (count($materialUsageCodes) === 1 && in_array('TOTAL-FUELS', $materialUsageCodes)) {
            $data['is_total'] = false; // Unchecked
        }

        return $data;
    }

    /**
     *  Handle the syncing of the record by deleting all existing records for this inventory_svac11_id
     */
    protected function beforeSave(): void
    {
        // Get the ID of the record being edited
        $inventoryId = $this->record->id;

        if ($inventoryId) {
            // Delete all existing records for this inventory_svac11_id
            \App\Models\Svac11Fuels::where('inventory_svac11_id', $inventoryId)->delete();
        }
    }
}
