<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SourceMaterial extends Model
{
    protected $fillable = [
        'name',
        'code',
        'data_activity_id',
        'notes',
    ];

    public function dataActivity(): BelongsTo
    {
        return $this->belongsTo(DataActivity::class);
    }

    public function serviceAccount(): BelongsToMany
    {
        return $this->belongsToMany(ServiceAccount::class);
    }

    public function entryUnit(): BelongsToMany
    {
        return $this->belongsToMany(EntryUnit::class);
    }
}
