<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Employee;
use App\Models\Check;
use App\Models\Leave;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use \Validator;
use DB;
use Hash;
use Auth;
use DateTime;

use Carbon\Carbon;
// use\Auth;
use App\Http\Requests\ScheduleEmp;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
   
    public function index()
    {

        $employee_id = DB::table('schedules')->pluck('employee_id');
     
        $schedule=DB::table('schedules')       
        ->whereDate('created_at',  Carbon::today()->toDateString())     
        ->get();

       
        return view('admin.attendance.schedule')->with(['schedules'=>$schedule, 'employees'=>Employee::all() ]);
        flash()->success('Success','Schedule has been created successfully !');

    
    }

    public function filter(Request $request)
        {
    $employee_id = DB::table('schedules')->pluck('employee_id');

    $optdates=Carbon::today()->toDateString();
    $todates=$request->to_date;
    $filter_dates=$todates ?? $optdates;
 
    $schedule=DB::table('schedules')    
    ->whereDate('created_at', $filter_dates )   
    ->get();

    return view('admin.attendance.schedule')->with(['schedules'=>$schedule, 'filter_dates'=>$filter_dates, 'employees'=>Employee::all() ]);
    flash()->success('Success','Schedule has been created successfully !');


    }

    public function store(Request $request)
    {

       $id=$request->employee_id;

        $station_id=Employee::select('station_id')->where('id', $id)->first();
        $days=Check::select('attendance_time')->where('emp_id', $id)->first(); 
        $inlands=Check::select('inland')->where('emp_id', $id)->first(); 
        $overlands=Check::select('overland')->where('emp_id', $id)->first();
        $rdate=Leave::select('return_date')->where('employee_id', $id)->first();
        $circle=Check::select('created_at')->where('emp_id', $id)->first();
        $stat_id=$station_id->station_id;  
        
       // $checkdaysss=$days->attendance_time;

        $yesterday = date("Y-m-d", strtotime( '-2 days' ) );
        $return_date=$rdate->return_date ?? $yesterday;
        $opt_date3=now();
        
        $opt_date1=$request->created ?? $opt_date3;
        //$opt_date2=$opt_date1->format('Y-m-d');

        $date22 = new DateTime($opt_date1);
        $opt_date2=$date22->format('Y-m-d');

        $opt_date=now()->format('Y-m-d');
        $leo=Schedule::whereDate('created_at', $opt_date2)
            ->where('employee_id', $id)
            ->count();
        
        if($request->mission == 'inland'){
            $dinland=1;
            $doverland=0;

        }elseif($request->mission == 'overland'){
            $dinland=0;
            $doverland=1;
        }else{
            $dinland=0;
            $doverland=0;
        }

    // if($checkdaysss>= 26){
    //     Session::flash('message','The attendance days are on record. 26 days have been recorded.');        
    //     return redirect()->route('schedule.index');
    // }else
    if($return_date > $opt_date3){

        Session::flash('message','The staff is on a sick leave.');        
        return redirect()->route('schedule.index');

    }else{

    if($leo > 0){
        
        //dd( $opt_date);
        Session::flash('message','User attendance for today has been clocked in. Please update!');        
        return redirect()->route('schedule.index');
    }else{
        //Fetched data from check db
        $created_at_date=$circle->created_at ?? $opt_date;
        $attendance=$days->attendance_time ?? "0";
        $fattendance=$attendance + 1;
        $ttoverland=$overlands->overland ?? "0";
        $ttinland=$inlands->inland ?? "0";
        // $dinland=$request->inland;       
        // $doverland=$request->overland;
        $fttoverland=$ttoverland+$doverland;
        $fttinland=$ttinland+$dinland;     
        
        
        $updated_date=Schedule::select('created_at')->where('employee_id', $id)->first();
        $today=now();
        $datetoday=$updated_date->created_at ?? $today;                
        $todays_date = date('d-m-Y');
        $dif = $datetoday->diff($todays_date)->format('%a');
        
        //Post new data to schedule db
        $schedule = new schedule;              
        $schedule->employee_id = $id;
        $schedule->nodays =1;    
        $schedule->station_id=$stat_id;    
        $schedule->inland = $dinland;
        $schedule->created_at=$request->created;
        $schedule->overland = $doverland;
        $schedule->time_in = $request->time_in;
        $schedule->time_in = $request->time_in;
        $schedule->time_out = $request->time_out;     
        $schedule->save();

        if (Check::where('emp_id', '=', $id)->exists()) {           
            $cleo=now();
            $tdate=$circle->created_at;
            $checkleo = new DateTime($cleo);
            $datetime2 = new DateTime($tdate);
            $interval = $checkleo->diff($datetime2);
            $checkdays = $interval->format('%a');//now do whatever you like with $days

           if($checkdays>= 30){
            Check::where('emp_id',$id)
            ->update([
                'attendance_time' => 1,
                'leave_time' => 0,
                'inland' => $dinland,
                'overland'=>$doverland,
                'created_at'=>$cleo

            ]);

           }else{
            //Update Attendance, Inland and Mission Overland on Check
            Check::where('emp_id',$id)
            ->update([
                'attendance_time' => $fattendance,
                'inland' => $fttinland,
                'overland'=>$fttoverland,
            ]);
           } 
           
         }else{
        $check = new check;
        $check->emp_id=$employee_id = $id; 
        $check->attendance_time = 1;
        $check->inland = $dinland;
        $check->overland = $doverland;
            
        $check->save();
         }
        Session::flash('Success','Schedule has been created successfully !');        
        return redirect()->route('schedule.index');
    }
}


}

public function sundaystore(Request $request){
    $id=$request->employee_id;
    $station_id=Employee::select('station_id')->where('id', $id)->first();
    //$days=Check::select('attendance_time')->where('emp_id', $id)->first(); 
    $inlands=Check::select('inland')->where('emp_id', $id)->first(); 
    $overlands=Check::select('overland')->where('emp_id', $id)->first();
    $circle=Check::select('created_at')->where('emp_id', $id)->first();
   // $checkupdate=Check::select('updated_at')->where('emp_id', $id)->first();
    $stat_id=$station_id->station_id;

    $opt_date3=now();
    
    $opt_date1=$request->created ?? $opt_date3;
    //$opt_date2=$opt_date1->format('Y-m-d');

    $date22 = new DateTime($opt_date1);
    $opt_date2=$date22->format('Y-m-d');

    $opt_date=now()->format('Y-m-d');
    $leo=Check::whereDate('updated_at', $opt_date2)
        ->where('emp_id', $id)
        ->count();
      

if($leo > 0){
    
    //dd( $opt_date);
    Session::flash('message','Mission days are upto date. Please update!');        
    return redirect()->route('schedule.index');
}else{
    //Fetched data from check db
    $created_at_date=$circle->created_at ?? $opt_date;
    $attendance=$days->attendance_time ?? "0";
    $fattendance=$attendance + 1;
    $ttoverland=$overlands->overland ?? "0";
    $ttinland=$inlands->inland ?? "0";

    $dinland=$request->inland;
   
    $doverland=$request->overland;
    $fttoverland=$ttoverland+$doverland;
    $fttinland=$ttinland+$dinland;       
    
    
    // $updated_date=Schedule::select('created_at')->where('employee_id', $id)->first();
    // $today=now();
    // $datetoday=$updated_date->created_at ?? $today;                
    // $todays_date = date('d-m-Y');
    // $dif = $datetoday->diff($todays_date)->format('%a');
    
    //Post new data to schedule db


    if (Check::where('emp_id', '=', $id)->exists()) {
       
        $cleo=now();
        $tdate=$circle->created_at;
        $checkleo = new DateTime($cleo);
        $datetime2 = new DateTime($tdate);
        $interval = $checkleo->diff($datetime2);
        $checkdays = $interval->format('%a');//now do whatever you like with $days

       if($checkdays>= 30){
        Check::where('emp_id',$id)
        ->update([
            //'attendance_time' => 1,
            'leave_time' => 0,
            'inland' => $dinland,
            'overland'=>$doverland,
            'created_at'=>$cleo

        ]);

       }else{
        //Update Attendance, Inland and Mission Overland on Check
        Check::where('emp_id',$id)
        ->update([
            //'attendance_time' => $fattendance,
            'inland' => $fttinland,
            'overland'=>$fttoverland,
        ]);
       } 
       
     }else{
    $check = new check;
    $check->emp_id=$employee_id = $id; 
    $check->attendance_time = 0;
    $check->inland = $dinland;
    $check->overland = $doverland;
        
    $check->save();
     }
    Session::flash('Success','Mission days has been updated !');        
    return redirect()->route('schedule.index');
}

}
    public function update(Request $request, $schedule)
    {

        $employee=Schedule::find($schedule);
        $id=$request->employee_id;

        $inland=$request->updatedinland;
        $overland=$request->updatedoverland;
        $rinland=$request->inland;
        $roverland=$request->overland;

        $object=Check::select('inland')->where('emp_id', $id)->first();
        $object1=Check::select('overland')->where('emp_id', $id)->first();
        $inland1=$object->inland ?? "0";
        $overland1=$object1->overland ?? "0";

        $finland=$inland1-$inland;
        $foverland=$overland1-$overland;
        $ffoverland=$foverland+$roverland;
        $ffinland=$finland+$rinland;

        $employee->time_in = $request->time_in;
        $employee->time_out = $request->time_out;
        $employee->inland = $request->inland;
        $employee->overland = $request->overland;
        $employee->update();

        Check::where('emp_id', $id)
            ->update([
                'inland' => $ffinland,
                'overland' => $ffoverland
                
            ]);

    
        Session::flash('Success','Mission days Updated successfully !');        
        return redirect()->route('schedule.index');
    }

  
    public function destroy(Request $request, $schedule)
    {
        $employee=Schedule::find($schedule);
        $employee->delete();
        Session::flash('Success','Schedule has been deleted successfully !');
        // flash()->success('Success','Schedule has been deleted successfully !');
        return redirect()->route('schedule.index');
    }

    public function calendar(){
 
        return view('admin.attendance.calendar')->with(['schedules'=>Schedule::all(), 'employees'=>Employee::all() ]);
    }

    
}
