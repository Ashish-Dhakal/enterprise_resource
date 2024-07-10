<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use function Monolog\Formatter\format;

class Attendance extends Model
{
    use HasFactory;

    protected $appends = [
        'clock_in', 'clock_out'
    ];
    protected $guarded = ['id'];

    public function getClockInAttribute()
    {
        return Carbon::parse($this?->clock_in_time)->format('h:m A');
    }

    public function getClockOutAttribute()
    {
        return Carbon::parse($this?->clock_out_time)->format('h:m A');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function leave(): BelongsTo
    {
        return $this->belongsTo(Leave::class);
    }
}
