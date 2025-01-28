<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventorySvac11 extends Model
{
    protected $fillable = [
        'entry_period_id',
        'period_list_id',
    ];

    public function svac11Fuels(): HasMany
    {
        return $this->hasMany(Svac11Fuels::class);
    }

    public function entryPeriod(): BelongsTo
    {
        return $this->belongsTo(EntryPeriod::class);
    }

    public function periodList(): BelongsTo
    {
        return $this->belongsTo(PeriodList::class);
    }
}
