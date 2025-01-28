<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EntryUnit extends Model
{
    protected $fillable = [
        'entry_measurement_id',
        'unit',
        'is_needwpu',
    ];

    public function entryMeasurement(): BelongsTo
    {
        return $this->belongsTo(EntryMeasurement::class);
    }

    public function sourceMaterial(): BelongsToMany
    {
        return $this->belongsToMany(SourceMaterial::class);
    }
}
