<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getAllDepartment()
    {
        return self::paginate(5);
    }

    public function positions(): HasMany    
    {
        return $this->hasMany(Position::class);
    }
}
