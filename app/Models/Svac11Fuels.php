<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Svac11Fuels extends Model
{
    protected $fillable = [
        'inventory_svac11_id',
        // 'source_material_id', // handled directly on Database, definie SOM by Brand Material
        'brand_material_id',
        'material_usage_id',
        'service_account_id',
        'consumption',
        'entry_unit_id',
        'emission',
        'error_margin_pct',
    ];

    // public function sourceMaterial(): BelongsTo
    // {
    //     return $this->belongsTo(SourceMaterial::class);
    // }

    public function brandMaterial(): BelongsTo
    {
        return $this->belongsTo(BrandMaterial::class);
    }

    public function materialUsage(): BelongsTo
    {
        return $this->belongsTo(MaterialUsage::class);
    }

    public function serviceAccount(): BelongsTo
    {
        return $this->belongsTo(ServiceAccount::class);
    }

    public function entryUnit(): BelongsTo
    {
        return $this->belongsTo(EntryUnit::class);
    }

    /**
     * Set Service Account default value to this model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($svac11fuels) {
            $svacid = ServiceAccount::where('code', '1-1-FUELS-HOTEL')->first();
            $svac11fuels->service_account_id = $svacid->id; // Default value for service_account_id.
        });

    }
}
