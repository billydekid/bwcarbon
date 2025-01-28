<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeriodList extends Model
{
    protected $fillable = [
        'entry_period_id',
        'period_value',
    ];

    public function entryPeriod(): BelongsTo
    {
        return $this->belongsTo(EntryPeriod::class);
    }
}
