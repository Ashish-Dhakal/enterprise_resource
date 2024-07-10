<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leave extends Model
{
    use HasFactory;
    protected $guarded=[];

    public static function getAll()
    {
        return self::paginate(5);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);

    }

    public function attendance()
    {
        return $this->hasOne(Attendance::class);
    }

}
