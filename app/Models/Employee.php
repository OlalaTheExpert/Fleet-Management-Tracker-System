<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle;
use App\Models\Station;
use App\Models\Employee;

class Employee extends Model
{
    use HasFactory, Notifiable;
    
    public function getRouteKeyName()
    {
        return 'name';
    }
    protected $table = 'employees';
    protected $fillable = [
        'name', 'email', 'pin_code'
    ];

  
    protected $hidden = [
        'pin_code', 'remember_token',
    ];


    

    public function vehicle()
    {
        return $this->belongsTo(vehicle::class);
    }
    public function station()
    {
        return $this->belongsTo(station::class);
    }

   public function incharge(){
    return $this->belongsTo(station::class);
   }
   public function user(){
    return $this->belongsTo(Employee::class);
   }




    public function check()
    {
        return $this->hasMany(Check::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
    public function latetime()
    {
        return $this->hasMany(Latetime::class);
    }
    public function leave()
    {
        return $this->hasMany(Leave::class);
    }
    public function overtime()
    {
        return $this->hasMany(Overtime::class);
    }
    public function schedules()
    {
        return $this->belongsToMany('App\Models\Schedule', 'schedule_employees', 'emp_id', 'schedule_id');
    }


    

}
