<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ServiceAccount extends Model
{
    protected $fillable = [
        'name',
        'code',
        'scope_id',
    ];

    public function scope(): BelongsTo
    {
        return $this->belongsTo(Scope::class);
    }

    public function sourceMaterial(): BelongsToMany
    {
        return $this->belongsToMany(SourceMaterial::class);
    }
}
