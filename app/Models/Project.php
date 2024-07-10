<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);

    }


    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'project_members', 'project_id', 'employee_id');

    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
