<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    protected $fillable = [
        'emp_id', 'attendance_time', 'leave_time', 'inland', 'overland',
      ];
    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }
}
