<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Employee;
use App\Models\Overtime;
use App\Models\FingerDevices;
use App\Helpers\FingerHelper;
use App\Models\Leave;
use App\Models\Check;

use App\Http\Requests\AttendanceEmp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use \Validator;

class LeaveController extends Controller
{
    public function index()
    {
        return view('admin.attendance.leave')->with(['leaves' => Leave::all(), 'employees'=>Employee::all()]);
    }

    public function indexOvertime()
    {
        return view('admin.overtime')->with(['overtimes' => Overtime::all(), 'employees'=>Employee::all()]);
    }
    public function leavestore(Request $request)
    {
     
            $id=$request->employee_id;
            $user=Check::find($id);
            $days=Check::select('attendance_time')->where('emp_id', $id)->first(); 
            $emp_id=Check::select('id')->where('emp_id', $user)->first(); 
            $e_id=$emp_id->id ?? $id;
            $nodays=$days->attendance_time ?? 0;
            $ttdays=$nodays+1;
              
            $leave = new Leave;
                  
            $start_time = Carbon::parse($request->input('leave_date'));
            $finish_time = Carbon::parse($request->input('return_date'));
            $results = $start_time->diffInDays($finish_time, false);

              
        // Get the value from the form
        $input['employee_id'] = Request('employee_id');
        

        // Must not already exist in the `email` column of `users` table
        $rules = array(
            'employee_id' => 'unique:leaves,employee_id'
            
        );
      

          $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
         
            $leave=Leave::find($id);
            $user=Leave::where('employee_id', $id)->update([
                'days'=>$results,
                'leave_date'=>$request->leave_date,
                'type'=>$request->type,
                'return_date'=>$request->return_date
               
            ]);

        }else{
            $leave->employee_id = $request->employee_id;
            $leave->days =$results;
            $leave->type =$request->type;
            $leave->leave_date = $request->leave_date;
            $leave->return_date = $request->return_date;     
            $leave->save();
            }           
    
            $data_array = [
                'leave_time' => $results,
                
            ];
            $employee = Check::updateOrCreate(['emp_id' => $id], $data_array);
    
            Session::flash('Success','Leave has been created successfully !');           
           
            return redirect()->back();
    }

    public static function overTimeStore(Request $request)
    {
        
        $id=$request->employee_id;       
        
        $time = $request->current_t;
        $timet = strtotime($request->start_t);
        $start_t=date('H:m:s',$timet);

        $datetime1 = strtotime($request->current_t);
        $datetime2 = strtotime($request->start_t);

        $secs = $datetime2 - $datetime1;
        $duration = $secs * 0.000277778;

        $days=Check::select('overtime15')->where('emp_id', $id)->first(); 
        $ot155=$days->overtime15 ?? "0";
        $fot15=$ot155 + $duration;
        
        $ot75=Check::select('overtime75')->where('emp_id', $id)->first(); 
        $ot755=$ot75->overtime75 ?? "0";
        $fot75=$ot755 + $duration; 

        $ot2=Check::select('overtime2')->where('emp_id', $id)->first(); 
        $ot22=$ot2->overtime2 ?? "0";
        $fot2=$ot22 + $duration; 

        $ot25=Check::select('overtime25')->where('emp_id', $id)->first(); 
        $ot225=$ot25->overtime25 ?? "0";
        $fot25=$ot225 + $duration; 

        $overtime = new Overtime();
        $overtime->emp_id = $request->employee_id;
        $overtime->overtime_category=$request->overtime_category;
        $overtime->duration = $duration;
        $overtime->time_in = $request->current_t;
        $overtime->time_out=$request->start_t;
        $overtime->overtime_date= $request->current_t;
        $overtime->save();
        $cat=$request->overtime_category;
        if (Check::where('emp_id', '=', $id)->exists()) {           
            
            if($cat=='ot15'){
                Check::where('emp_id',$id)
                ->update([
                    'overtime15'=> $fot15,
                    
                ]);
            }elseif($cat=='ot75'){
                Check::where('emp_id',$id)
                ->update([
                    'overtime75'=> $fot75,
                    
                ]); 
            }elseif($cat=='ot2'){
                Check::where('emp_id',$id)
                ->update([
                    'overtime2'=> $fot2,
                    
                ]); 
            } else{
                Check::where('emp_id',$id)
                ->update([                   
                    'overtime25'=> $fot25,                    
                ]); 
            }        
           
           
         }else{
        if($cat=='ot15'){
        $check = new check;
        $check->emp_id=$employee_id = $id; 
        $check->attendance_time = 0;
        $check->inland = 0;
        $check->overland = 0;
        $check->overtime15=$duration;
        $check->overtime75=0;
        $check->overtime2=0;
        $check->overtime25=0;
            
        $check->save();
        }elseif($cat=='ot75'){
            $check = new check;
            $check->emp_id=$employee_id = $id; 
            $check->attendance_time = 0;
            $check->inland = 0;
            $check->overland = 0;
            $check->overtime15=0;
            $check->overtime75=$duration;
            $check->overtime2=0;
            $check->overtime25=0;
                
            $check->save();

        }elseif($cat=='ot2'){
            $check = new check;
            $check->emp_id=$employee_id = $id; 
            $check->attendance_time = 0;
            $check->inland = 0;
            $check->overland = 0;
            $check->overtime15=0;
            $check->overtime75=0;
            $check->overtime2=$duration;
            $check->overtime25=0;
                
            $check->save();
        }else{
            $check = new check;
            $check->emp_id=$employee_id = $id; 
            $check->attendance_time = 0;
            $check->inland = 0;
            $check->overland = 0;
            $check->overtime15=0;
            $check->overtime75=0;
            $check->overtime2=0;
            $check->overtime25=$duration;
                
            $check->save();
        }

         }
         
        Session::flash('Success','Overtime created successfully !');        
        return back()
        ->with('success','Overtime created successfully.');

    
    }
}
