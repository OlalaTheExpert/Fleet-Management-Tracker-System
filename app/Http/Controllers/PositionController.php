<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use \Validator;
use DB;
use Hash;
use Auth;


class PositionController extends Controller
{
    public function index(){

        $positions= Position::all();        
        return view('admin.positions', compact('positions'));
    }

    public function store(Request $request){

        $mrate=$request->monthly_rate;
        $daily_rates=$mrate/26;

        $position = new Position;

        $position->position = $request->position; 
        $position->monthly_rates= $request->monthly_rate;
        $position->daily_rates=$daily_rates; 
        $position->created_at = Carbon::now();
        $position->updated_at = Carbon::now();
        $position->save();
        
        Alert::success('Success','Job Position has been created successfully !');
        Session::flash('Success','Job Position has been created successfully !');
        return redirect()->route('positions');
    }

    public function edit(Request $request, $id){
        $mrate=$request->monthly_rate;
        $daily_rates=$mrate/26;

        $position=Position::find($id);
        

        $position->position = $request->position; 
        $position->monthly_rates=$mrate;
        $position->daily_rates=$daily_rates;       
        $position->pin_code = bcrypt($request->pin_code);
        $position->update();

        $jobgroup=Position::select('position')->where('id', $id)->first();
        $positions=$jobgroup->position; 

        $employee = DB::table('employees')
              //->where('position_id', $id)
              ->where('position', $positions)
              ->update(
                [
                    'monthly_rates'=>$mrate,
                    'bsalary'=>$daily_rates,
                    'position'=>$positions,
                    'position_id'=>$id

                ]);
        // $employee=Employee::find($id);
        // $employee->monthly_rates=$mrate;
        // $employee->bsalary=$daily_rates; 
        // $employee->position=$request->position; 
        // $employee->update();
        Session::flash('Success', 'Job Position has been Updated successfully !');        
        return redirect()->route('positions');
        
    }

    public function update(Request $request, $id){

        $position=Position::find($id);  
        return view('admin.edit-position', ['position'=>$position]);
    }

    public function delete($id){

        $position=Position::find($id);
        $position->delete();       
        
        // if (request()->wantsJson()) {
        //     return response([], 204);
        // }
        Alert::success('Success','Job group has been removed successfully !');
        Session::flash('Success', 'Job group has been removed successfully !');
        return redirect()->route('positions')->with('success');
    }
}
