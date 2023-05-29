<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use HasFactory;
use App\Models\User;

use Illuminate\Support\Str;

use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){
        //\App\Models\User::factory(1)->create();

        User::create([        
            'name' => 'Admin',
            'email' => 'admin@fleet.com',
            'password' => Hash::make('admin@00'),
            'remember_token' => Str::random(10),
            'permissions'=>'1',
            'pin_code' => Str::random(10),
            'email_verified_at' => now(),
            'role'=>'1',
            'fullname'=>'Administrator',
            'employee_id'=>'0',
            'station_id'=>'0',
            
            
        ]);
        // \App\Models\Employee::factory(10)->create()->make();
        

   

        // $role = Role::create([
        //     'slug' => 'admin',
        //     'name' => 'Adminstrator',
        // ]);
        // $user->roles()->sync($role->id);
        
        // \App\Models\Position::factory(10)->create()->make();
        // \App\Models\Vehicle::factory(10)->create()->make();
    }

    }



// $user= User::create([
//     'name' => 'Admin',
//     'email' => 'admin@fleet.com',
//     'password' => Hash::make('admin@00.com'),
// ]);
// $role = Role::create([
//     'slug' => 'admin',
//     'name' => 'Adminstrator',
// ]);
// $user->roles()->sync($role->id);
// }
