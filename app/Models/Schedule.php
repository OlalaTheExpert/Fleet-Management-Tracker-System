<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
      'emp_id', 'inland', 'overland',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function employees()
    {
        return $this->belongsToMany('App\Models\Employee', 'schedule_employees', 'schedule_id', 'employee_id');
    }
}
