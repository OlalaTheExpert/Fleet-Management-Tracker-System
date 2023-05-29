<?php

namespace App\Models; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    public function getRouteKeyName()
    {
        return 'name';
    }
    
    public function getEmployee()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role');
    }

    // public function hasAnyRole($roles)
    // {
    //     if (Is_array($roles)) {
    //         foreach ($roles as $role) {
    //             if ($this->hasRole($role)) {
    //                 return true;
    //             }
    //         }
    //     } else {
    //         if ($this->hasRole($roles)) {
    //             return true;
    //         }
    //     }

    //     return false;
    // }

    public static function hasRole($role)
    {
        if (auth()->user()->roles()->first()->slug === $role) {
            return true;
        }
        return false;
    }

   
    protected $fillable = [
        'name', 'email', 'password', 'pin_code', 'role', 'fullname', 'station_id', 'employee_id',
    ];

  
    protected $hidden = [
        'pin_code','password', 'remember_token',
    ];

  
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
