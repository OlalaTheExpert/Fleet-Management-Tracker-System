<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Station;
use App\Models\Vehicle;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;


class StationController extends Controller
{
    public function index(){
        $user = auth()->user();       
       
        if($user->role=='Data-Clerk' || $user->role=='1'){

        return view('admin.stations.index')->with(
            [
            'employees'=> Employee::all(), 
            'stations'=>Station::all()
        ]);
    }else{
        if($user->role=='0'){            
            Session::flash('Success','You are logged in as Employee');
        }else{
            Session::flash('Success','You are logged in as Duty Station Incharged');
        }

        return redirect()->route('home');
       
    }
    
    }

    public function stationsincharge(){
        // $employees = Employee::with('emp_employee')->get();
        $employees = Employee::with('station')->get();
        // $vehicles = Vehicle::with('employee')->get();
        $stations = Station::with('emp_employee')->get();
        $positions=Position::all();   
        return view('admin.stations.stationsincharge', compact('employees', 'positions', 'stations'));
    }

    public function store(Request $request){

        $station = new Station;

        $station->station = $request->station; 
        $station->incharge_id = $request->incharge_id; 
        $station->created_at = Carbon::now();
        $station->updated_at = Carbon::now();
        $station->save();
        
        Alert::success('Success','New Station has been created successfully !');
        Session::flash('Success','New Station has been created successfully !');
        return redirect()->route('stations');
    }

    public function edit(Request $request, $id){

        $station=Station::find($id);        
        $station->station = $request->station;        
        $station->incharge_id = $request->incharge_id;
        $station->update();    

        Session::flash('Success', 'Duty Station has been Updated successfully !');        
        return redirect()->route('stations');
        
    }

    public function update(Request $request, $id){

        $station=Station::find($id);  
        return view('admin.stations.edit-stations', ['station'=>$station, 'employees'=> Employee::all()]);
    }

    public function delete($id){

        $station=Station::find($id);
        $station->delete();       
        
        // if (request()->wantsJson()) {
        //     return response([], 204);
        // }
        Alert::success('Success','Job group has been removed successfully !');
        Session::flash('Success', 'Job group has been removed successfully !');
        return redirect()->route('stations')->with('success');
    }

}
