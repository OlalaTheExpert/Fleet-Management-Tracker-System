<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Payment;
use App\Models\Station;
use App\Models\Position;
use App\Models\Vehicle;
use App\Models\Latetime;
use App\Models\Attendance;
use Illuminate\Support\Facades\Session;
use DB;
use Auth;


class AdminController extends Controller
{

 
    public function index()
    {
        $user = auth()->user();
        
        if($user->permissions=='0'){
            Session::flush();        
            Auth::logout();
            Session::flash('message', 'Account Blocked !');                    
            return redirect()->back();

        }  else  if($user->role=='0'){
            $user = auth()->user(); 
        
        $user_id=auth()->user()->employee_id;
        $data= DB::table('employees')
        ->join('payments', 'employee_id', "=", 'employees.id')
        ->where('employees.id', $user_id)
        ->get();

        $employees = Employee::with('station')->get();
        
        return view('admin.employee-dashboard', ['user'=>$data, 'employee'=>$employees]);

        }else if($user->role=='Station-Incharge'){
            
            $emplCount = Employee::count();
            $positionCount = position::count();
            $stationCount = Station::count();
            $vehicleCount = Vehicle::count();
            $user = auth()->user();            
            $user_id=auth()->user()->employee_id;
            $data= DB::table('employees')
            ->join('payments', 'employee_id', "=", 'employees.id')
            ->where('employees.id', $user_id)
            ->get();
    
            $employees = Employee::with('station')->get();
           
            return view('station-admin.index', 
            [
            'user'=>$data, 
            'employee'=>$employees,
            'vehicleCount'=>$vehicleCount,
            'stationCount'=>$stationCount,
            'positionCount'=>$positionCount,
            'emplCount'=>$emplCount
        ]);
        }
        else{
            $emplCount = Employee::count();
            $positionCount = position::count();
            $stationCount = Station::count();
            $vehicleCount = Vehicle::count();
            return view('admin.index', compact('emplCount', 'positionCount', 'stationCount', 'vehicleCount'));
        }

    }

    public function employees(){

        return view('admin.employ');
    }

    

}
