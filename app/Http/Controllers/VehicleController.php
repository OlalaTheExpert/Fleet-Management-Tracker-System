<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class VehicleController extends Controller
{
    public function index(){
        $vehicles= Vehicle::all();        
        return view('admin.vehicle.vehicle', compact('vehicles'));
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

        $vehicle=Vehicle::find($id);  
        return view('admin.vehicle.edit-vehicle', ['vehicle'=>$vehicle]);
    }

    public function delete($id){

        $vehicle=Vehicle::find($id);
        $vehicle->delete();       
        
        Alert::success('Success','Vehicle details has been removed successfully !');
        Session::flash('Success', 'Vehicle details has been removed successfully !');
        return redirect()->route('vehicles')->with('success');
    }
}
