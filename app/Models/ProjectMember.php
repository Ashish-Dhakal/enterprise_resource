<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    use HasFactory;

    protected  $guarded = ['id'];

    //    protected $primaryKey = 'id';
    //    public $incrementing = true;

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
