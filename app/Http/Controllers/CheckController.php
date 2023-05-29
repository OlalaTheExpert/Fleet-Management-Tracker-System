<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Leave;
use DateTime;

class CheckController extends Controller
{
    public function index()
    {
        return view('admin.check')->with(['employees' => Employee::all()]);
    }

    public function days(Request $request, $id){
        $employee_id=Check::find($id);
        $employee_id = Request('emp_id');
        $rules1 = array(
            
            'employee_id'=>'unique:checks,emp_id'
        );

        $validator1=Validator::make($employee_id, $rules1);
        
        if(!empty($validator->fails())) {
            $employee=Check::where('emp_id', $id)->update([
                'attendance_time'=>$ttdays               
            ]);
        }else{         
            $check = new Check;              
            $check->emp_id = $request->employee_id;
            $check->attendance_time = 1;
            $check->leave_time=0;
            $check->save();

        }
    }

    public function CheckStore(Request $request)
    {
        if (isset($request->attd)) {
            foreach ($request->attd as $keys => $values) {
                foreach ($values as $key => $value) {
                    if ($employee = Employee::whereId(request('emp_id'))->first()) {
                        if (
                            !Attendance::whereAttendance_date($keys)
                                ->whereEmp_id($key)
                                ->whereType(0)
                                ->first()
                        ) {
                            $data = new Attendance();
                            
                            $data->emp_id = $key;
                            $emp_req = Employee::whereId($data->emp_id)->first();
                            $data->attendance_time = date('H:i:s', strtotime($emp_req->schedules->first()->time_in));
                            $data->attendance_date = $keys;
                            
                           
                            $data->save();
                        }
                    }
                }
            }
        }
        if (isset($request->leave)) {
            foreach ($request->leave as $keys => $values) {
                foreach ($values as $key => $value) {
                    if ($employee = Employee::whereId(request('emp_id'))->first()) {
                        if (
                            !Leave::whereLeave_date($keys)
                                ->whereEmp_id($key)
                                ->whereType(1)
                                ->first()
                        ) {
                            $data = new Leave();
                            $data->emp_id = $key;
                            $emp_req = Employee::whereId($data->emp_id)->first();
                            $data->leave_time = $emp_req->schedules->first()->time_out;
                            $data->leave_date = $keys;
                          
                            $data->save();
                        }
                    }
                }
            }
        }
        flash()->success('Success', 'You have successfully submited the attendance !');
        return back();
    }

    public function sheetReport(Request $request, $id)
    {

    $employees=Employee::find($id);
    $today= today();
    return view('admin.attendance.sheet-report')->with(['employee' => $employees, 'date'=>$today ]);
    }

    public function filter(Request $request){
        $todate=$request->to_date;    
        $today = date('Y-m-d H:i:s', strtotime($todate));
        $show=date('F', strtotime($todate));       
        $id=$request->employee_id;
        $employees=Employee::find($id);
        return view('admin.attendance.sheet-report')->with(['employee' => $employees, 'date'=>$today, 'show'=>$show ]);
    
    }
}
