<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\Station;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;




class DriverController extends Controller
{
    public function index(){
        return view('admin.drivers.index')->with([
            'employees'=> Employee::all(), 
            'positions'=>Position::all(), 
            'vehicles'=>Vehicle::all(),
            'stations'=>Station::all(),

        ]);
    }
    public function driverlogs(){

        

        $employees = Employee::with('vehicle')->get();
        $employees = Employee::with('station')->get();
        $vehicles = Vehicle::with('employee')->get();
        $stations = Station::with('employee_station')->get();
        $positions=Position::all();  
        return view('admin.drivers.driverlogs', compact('employees', 'vehicles', 'positions', 'stations'));
    }

    public function store(Request $request){

        $vehicle = new Vehicle;

        $vehicle->type = $request->type;        
        $vehicle->model = $request->model; 
        $vehicle->color = $request->color;  
        $vehicle->plateno = $request->plateno;
        $vehicle->created_at = Carbon::now();
        $vehicle->updated_at = Carbon::now();
        $vehicle->save();
        
        Alert::success('Success','Vehicle has been created successfully !');
        Session::flash('Success','Vehicle has been created successfully !');
        return redirect()->route('vehicles');
    }

    public function edit(Request $request, $id){

        $vehicle=Vehicle::find($id);        
        $vehicle->type = $request->type;        
        $vehicle->model = $request->model; 
        $vehicle->color = $request->color;  
        $vehicle->plateno = $request->plateno;      
        $vehicle->update();    

        Session::flash('Success', 'Vehicle Details has been Updated successfully !');        
        return redirect()->route('vehicles');
        
    }

    public function update(Request $request, $id){

        $employee=Employee::find($id);
                  
        return view('admin.drivers.assign-drivers', 
        ['employee'=>$employee, 
            'positions'=>Position::all(),
            'vehicles'=>Vehicle::all(),
            'stations'=>Station::all()
        ]);
    }

    public function delete($id){

        $vehicle=Vehicle::find($id);
        $vehicle->delete();       
        
        Alert::success('Success','Vehicle details has been removed successfully !');
        Session::flash('Success', 'Vehicle details has been removed successfully !');
        return redirect()->route('vehicles')->with('success');
    }

    // ============Driver Roles Functions==========
    public function driverrole(Request $request, $id){

        $employee=Employee::find($id);        
        $employee->vehicle_id = $request->vehicle_id;        
        $employee->mission = 'mission';           
        $employee->stat = 'assigned';      
        $employee->update();    

        Session::flash('Success', 'Driver Details has been Updated successfully !');        
        return redirect()->route('drivers');
        
    }

    public function updaterole(Request $request, $id){

        $employee=Employee::find($id);
                  
        return view('admin.drivers.assign-drivers', ['employee'=>$employee, 'positions'=>Position::all(),'vehicles'=>Vehicle::all()]);
    }

    public function deleterole($id){

        $vehicle=Vehicle::find($id);
        $vehicle->delete();       
        
        Alert::success('Success','Vehicle details has been removed successfully !');
        Session::flash('Success', 'Vehicle details has been removed successfully !');
        return redirect()->route('vehicles')->with('success');
    }
}
