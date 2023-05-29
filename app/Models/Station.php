<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\Models\Vehicle;
use App\Models\Station;

class Station extends Model
{
    use HasFactory;
    public function employee_station()
    {
        return $this->hasMany(Station::class, 'id', 'station_id');
    }

   
    public function emp_employee()
    {
        return $this->hasMany(Station::class, 'incharge_id', 'id');
    }
   


   
    
}
