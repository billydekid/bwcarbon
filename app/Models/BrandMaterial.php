<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BrandMaterial extends Model
{
    protected $fillable = [
        'source_material_id',
        'name',
        'notes',
    ];

    public function sourceMaterial(): BelongsTo
    {
        return $this->belongsTo(SourceMaterial::class);
    }
}
