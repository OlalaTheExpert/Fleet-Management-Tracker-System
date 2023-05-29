<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Position;
use App\Models\Station;
use App\Models\Payment;
use App\Models\History;
use App\Models\Check;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use \Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($id){       
        $employee=Employee::find($id);

        $data= DB::table('employees')
        ->join('checks', 'emp_id', "=", 'employees.id')
        ->where('employees.id', $id)
        ->get();

        $month = date('m');

        $updated_date=Leave::select('created_at')->where('employee_id', $id)->first();
        $today=now();
        $datetoday=$updated_date->created_at ?? $today;                
        $todays_date = date('m');
        // $dif = $datetoday->diff($todays_date)->format('%a');
            
        if($todays_date==$datetoday){
            
            $leave= DB::table('employees')
            ->join('leaves', 'employee_id', "=", 'employees.id')
            ->where('employees.id', $id)
        //    ->whereMonth('created_at', $month)
            ->get();
    
           
            $end = new Carbon('last day of last month');        
            return view('admin.payment.index', ['employee'=>$employee, 'data'=>$data,'datemonth'=>$datemonth,'month'=>$month,  'leaves'=>$leave, 'positions'=>Position::all(), 'end'=>$end]);
           
        }else{
            $object=Leave::select('created_at')->where('employee_id', $id)->first();
            $today=now();
            $datetoday=$updated_date->created_at ?? $today;                
            $todays_date = date('m');

            $datemonth=$datetoday->format('m');


            $leave= DB::table('employees')
            ->join('leaves', 'employee_id', "=", 'employees.id')
            ->where('employees.id', $id)
        //    ->whereMonth('created_at', $month)
            ->get();
    
        //$leave='0';
           
            $end = new Carbon('last day of last month');        
            return view('admin.payment.index', ['employee'=>$employee,'datemonth'=>$datemonth,'month'=>$month, 'data'=>$data, 'leaves'=>$leave, 'positions'=>Position::all(), 'end'=>$end]);
           
        }



      
    }
   

    public function payrollfilter(Request $request){
        $testdates = DB::table('histories')->pluck('created_at');
        $optdates1=today();
        $date1=$request->to_date;
        $month=Carbon::parse($date1)->format('m');    
        $year=Carbon::parse($date1)->format('Y');

        $todates = Carbon::parse($date1)->format('F Y');
        $filter_dates=$todates ?? $optdates;   
     
        $schedule=DB::table('histories')
        ->whereYear('created_at', '=', $year)
            
        ->whereMonth('created_at', $month )       
        ->get();

        $end = new Carbon('last day of this month');  
    
        return view('admin.payment.payment_list')->with([
            'payments'=> $schedule,            
            'employees'=> Employee::all(),
            'filter_dates'=>$filter_dates,
            //'schedules'=>$schedule,
            'end'=>$end  

        ]);   
    }
    public function store(Request $request)
    {       
        // =====Variables required======
        $employee_id=$request->input('employee_id');
        $inland = $request->input('inland') ?? "0";
        $overland=$request->input('overland') ?? "0";
        $dsainland=22.29;
        $dsaoverland=36.22;
        $id=$employee_id;
        $indsa=$inland * $dsainland;
        $ovedsa=$overland*$dsaoverland;
        $dsaamount=$indsa + $ovedsa;

        //Total Amount Calculations
        $daysworked=$request->input('daysworked');
        $monthlyrate=$request->input('bsalary');
         
        $days=Check::select('overtime15')->where('emp_id', $id)->first(); 
        $ot15=$days->overtime15 ?? "0";
        
        $dot75=Check::select('overtime75')->where('emp_id', $id)->first(); 
        $ot175=$dot75->overtime75 ?? "0";

        $dot2=Check::select('overtime2')->where('emp_id', $id)->first(); 
        $ot2=$dot2->overtime2 ?? "0";

        $dot25=Check::select('overtime25')->where('emp_id', $id)->first(); 
        $ot25=$dot25->overtime25 ?? "0";

        $hourlyrate=$monthlyrate/8;
        $ttover15=($hourlyrate * $ot15)/1.5;
        $ttover75=($hourlyrate *$ot175)/1.5;
        $ttover2=($hourlyrate *$ot2)/1.5;
        $ttover25=($hourlyrate * $ot25)/1.5;

        $ttovertime = $ttover15 + $ttover75 + $ttover2 + $ttover25;


   
        $leavedays=$request->sickleave;
        $annleave=$request->annualleave;
        
        $sickleave=$leavedays * $monthlyrate;
        $annualleave=$leavedays * $monthlyrate;
        $ttleavedays=$sickleave+ $annualleave;
        $grosssalary=$daysworked*$monthlyrate;
        $grosssal=$grosssalary+$ttleavedays;
        $ttsalary=$grosssal+$dsaamount + $ttovertime; 

        $employee = new Payment;
        $employee->employee_name = $request->employee_name;
        $employee->employee_id=$request->employee_id;
        $employee->ctgnumber=$request->ctgnumber;
        $employee->bsalary=$request->bsalary;
        $employee->daysworked=$request->daysworked ?? '0';
        $employee->inland=$request->inland ?? "0";
        $employee->overland=$request->overland ?? "0";
        $employee->sickleave=$request->sickleave ?? "0";
        $employee->annualleave=$request->annualleave ?? "0";
        $employee->ot15=$ot15;
        $employee->ot175=$ot175;
        $employee->ot2=$ot2;
        $employee->ot25=$ot25;
        $employee->dsainland=$indsa;
        $employee->dsaoverland=$ovedsa;
        $employee->dsaamount=$dsaamount;
        $employee->ttsalary=$ttsalary; 
        $employee->batch=$request->batch;     

        // Get the value from the form
        $input['employee_id'] = Request('employee_id');

        // Must not already exist in the `email` column of `users` table
        $rules = array('employee_id' => 'unique:payments,employee_id');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            Alert::warning('Failed','Payment Record already exist on the payroll!');
            
        }
        else {
            $attendance = DB::table('checks')              
            ->where('emp_id', $request->employee_id)
            ->update(
              [
                  'attendance_time'=>'0',
                  'leave_time'=>'0',
                  'inland'=>'0',
                  'overland'=>'0',
                  'overtime15'=>'0',
                  'overtime75'=>'0',
                  'overtime2'=>'0',
                  'overtime25'=>'0'

              ]);
            Alert::success('Success','Payment Records has been created successfully !');
            Session::flash('Success','Payment Records has been created successfully !');
            $employee->save();
        }   
        Employee::where('id', $employee->employee_id=$request->employee_id)->update([
            
            'stat' => 1
        ]);
     
        return redirect()->route('payments_list');
    }

    
    public function updateall(Request $request){

        $employee_id = DB::table('payments')->pluck('employee_id');

        $dsainland=22.29;
        $dsaoverland=36.22;

        $currentMonth = date('F');
        $currentYear = date('Y');

        
        foreach ( $employee_id as $user) {
            $batchno=Payment::select('batch')->where('employee_id', $user)->first();
            $batch=$batchno->batch;

        if (Payment::where('employee_id', $user )->exists() && Payment::where('batch', $batch )->exists()) {
            Alert::warning('Warning','Payroll is upto date, wait for next month !');
            Session::flash('message','Payroll is upto date, wait for next month !');
            return redirect()->route('payments_list');
        }else{

        
        if (Payment::where('employee_id', '=', $user)->exists()){

            //Fetching daily rates
            $monthly=Employee::select('monthly_rates')->where('id', $user)->first();
            $monthlyrate=$monthly->monthly_rates;

            $fname=Employee::select('name')->where('id', $user)->first();
            $employee_name=$fname->name;
            $ctg=Employee::select('ctgnumber')->where('id', $user)->first();
            $ctgnumber=$ctg->ctgnumber;

            //Fetching daily attendance
            $days = DB::table('checks')->select('attendance_time')
            ->Where ('emp_id', $user)
            ->get();

            $days=Check::select('attendance_time')->where('emp_id', $user)->first();
            $daysworked=$days->attendance_time ?? "0";


            //Overtimes
            $days=Check::select('overtime15')->where('emp_id', $user)->first(); 
            $ot15=$days->overtime15 ?? "0";
            
            $dot75=Check::select('overtime75')->where('emp_id', $user)->first(); 
            $ot175=$dot75->overtime75 ?? "0";
    
            $dot2=Check::select('overtime2')->where('emp_id', $user)->first(); 
            $ot2=$dot2->overtime2 ?? "0";
    
            $dot25=Check::select('overtime25')->where('emp_id', $user)->first(); 
            $ot25=$dot25->overtime25 ?? "0";

            //Fetching sickleaves
          
            $sickleave=Check::select('leave_time')->where('emp_id', $user)->first(); 
            $leavedays=$sickleave->leave_time ?? "0";

            //Fetching mission inland and overland
            $inland= DB::table('checks')->select('inland')
            ->Where ('emp_id', $user)
            ->get();

            $overland= DB::table('checks')->select('overland')
            ->Where ('emp_id', $user)
            ->get();

            $inlanddays = $inland[0]->inland ?? "0";
            $overlanddays=$overland[0]->overland ?? "0"; 
           
            if($daysworked > 26){
                $closedaysworked=26;
            }else{
                $closedaysworked=$request->daysworked;
            }
            
            $indsa=$inlanddays * $dsainland;
            $ovedsa=$overlanddays*$dsaoverland;

            $dsaamount=$indsa + $ovedsa;
    
            $hourlyrate=$monthlyrate/8;
            $ttover15=($hourlyrate * $ot15)/1.5;
            $ttover75=($hourlyrate *$ot175)/1.5;
            $ttover2=($hourlyrate *$ot2)/1.5;
            $ttover25=($hourlyrate * $ot25)/1.5;
    
            $ttovertime = $ttover15 + $ttover75 + $ttover2 + $ttover25;
    
            $sickleave=$leavedays * $monthlyrate;
            $annualleave=$leavedays * $monthlyrate;
            $ttleavedays=$sickleave+ $annualleave;
            $grosssalary=$closedaysworked*$monthlyrate;
            $grosssal=$grosssalary+$ttleavedays;
            $ttsalary=$grosssal+$dsaamount + $ttovertime;
    
           
    
            //Reformate Attendance sheet
            Check::where('emp_id','=',$user)              
            
            ->update(
              [
                  'attendance_time'=>'0',
                  'leave_time'=>'0',
                  'inland'=>'0',
                  'overland'=>'0',
                  'overtime15'=>'0',
                  'overtime75'=>'0',
                  'overtime2'=>'0',
                  'overtime25'=>'0'
    
              ]);

            Payment::where('employee_id','=',$user)
            
            ->update([
                'bsalary'=>$monthlyrate,       
                'daysworked' => $daysworked ?? 0,
                'sickleave' => $leavedays,
                'inland' => DB::Raw($inland[0]->inland),
                'overland' => DB::Raw($overland[0]->overland),
                'ot15'=>$ot15 ?? 0,
                'ot175'=>$ot175 ?? 0,
                'ot2'=>$ot2 ?? 0,
                'ot25'=>$ot25 ?? 0,
                'dsainland'=>$indsa ?? 0,
                'dsaoverland'=>$ovedsa ?? 0,
                'dsaamount'=>$dsaamount ?? 0,
                'ttsalary'=>$ttsalary ?? 0,
                'batch'=>$currentMonth.'/'.$currentYear

            ]);

        
    
            // =======History Table======================
            Payment::query()
            ->each(function ($oldPost) {
             $newPost = $oldPost->replicate();
             $newPost->setTable('histories');
             $newPost->save();
         
           });
           Alert::success('Success','Payment Records has been created successfully !');
            Session::flash('Success','Payment Records has been created successfully !');
            return redirect()->route('payments_list');
        }else{

            Alert::success('message','Error !');
            Session::flash('message','Error !');
            return redirect()->route('payments_list');
        }
    }
}
 }
   

    public function update(Request $request, $id){

        $payments=Payment::find($id);
        $employee=Employee::find($id);


        
        $data= DB::table('employees')
        ->join('checks', 'emp_id', "=", 'employees.id')
        ->where('employees.id', $id)
        ->get();
     
        $object=Leave::select('created_at')->where('employee_id', $id)->first();
        
            $today=now();
            $todayfor=$today->format('m');
            $datemonth=$updated_date->created_at ?? $todayfor;
            $leavedates = Leave::where('employee_id',$id)->get();
            $month = date('m');
            
            $leave= DB::table('employees')
            ->join('leaves', 'employee_id', "=", 'employees.id')
            ->where('employees.id', $id)
            ->get();
        
        return view('admin.payment.edit_list', ['data'=>$data,'datemonth'=>$datemonth,'month'=>$month,  'leaves'=>$leave, 'payment'=>$payments, 'employees'=>$employee]);
    }

    public function edit(Request $request, $id)
    {
        $payment=Payment::find($id); 
        $emp=Employee::find($id);  
        $batch=$request->batch; 
        
        //$id=$request->employee_id;

        $days=Check::select('overtime15')->where('emp_id', $id)->first(); 
        $ot15=$days->overtime15 ?? "0";
        
        $dot75=Check::select('overtime75')->where('emp_id', $id)->first(); 
        $ot175=$dot75->overtime75 ?? "0";

        $dot2=Check::select('overtime2')->where('emp_id', $id)->first(); 
        $ot2=$dot2->overtime2 ?? "0";

        $dot25=Check::select('overtime25')->where('emp_id', $id)->first(); 
        $ot25=$dot25->overtime25 ?? "0";


      
    if (History::where('employee_id', $id )->exists() && History::where('batch', $batch )->exists()) {
        Alert::warning('Warning','Payroll is upto date, wait for next month !');
        Session::flash('message','Payroll is upto date, wait for next month !');
        return redirect()->route('payments_list');
    }else{

 // =====Variables required======
        $employee_id=$request->input('employee_id');
        $inland = $request->input('inland') ?? "0";
        $overland=$request->input('overland') ?? "0";
        $dsainland=22.29;
        $dsaoverland=36.22;
       
        $indsa=$inland * $dsainland;
        $ovedsa=$overland*$dsaoverland;
        $dsaamount=$indsa + $ovedsa;

        //Total Amount Calculations
        $daysworked=$request->input('daysworked');
        $monthlyrate=$request->input('bsalary');

        if($request->daysworked > 26){
            $closedaysworked=26;
        }else{
            $closedaysworked=$request->daysworked;
        }
        

        $hourlyrate=$monthlyrate/8;
        $ttover15=($hourlyrate * $ot15)/1.5;
        $ttover75=($hourlyrate *$ot175)/1.5;
        $ttover2=($hourlyrate *$ot2)/1.5;
        $ttover25=($hourlyrate * $ot25)/1.5;

        $ttovertime = $ttover15 + $ttover75 + $ttover2 + $ttover25;

        $leavedays=$request->sickleave;
        $annleave=$request->annualleave;
        $sickleave=$leavedays * $monthlyrate;
        $annualleave=$leavedays * $monthlyrate;
        $ttleavedays=$sickleave+ $annualleave;
        $grosssalary=$closedaysworked*$monthlyrate;
        $grosssal=$grosssalary+$ttleavedays;
        $ttsalary=$grosssal+$dsaamount + $ttovertime;

       

        //Reformate Attendance sheet
        $attendance = DB::table('checks')              
        ->where('emp_id', $id)
        ->update(
          [
              'attendance_time'=>'0',
              'leave_time'=>'0',
              'inland'=>'0',
              'overland'=>'0',
              'overtime15'=>'0',
              'overtime75'=>'0',
              'overtime2'=>'0',
              'overtime25'=>'0'

          ]);

          $payment=DB::table('payments')
          ->where('employee_id', $id)
          ->update(
            [
                'bsalary'=>$monthlyrate,
                'daysworked'=>$closedaysworked ?? "0",
                'inland'=>$request->inland,
                'overland'=>$request->overland,
                'sickleave'=>$request->sickleave ?? "0",
                'annualleave'=>$request->annualleave ?? "0",
                'ot15'=>$ot15,
                'ot175'=>$ot175,
                'ot2'=>$ot2,
                'ot25'=>$ot25,
                'dsainland'=>$indsa,
                'dsaoverland'=>$ovedsa,
                'dsaamount'=>$dsaamount,
                'ttsalary'=>$ttsalary,   
                'batch'=>$request->batch

            ]
            );
    
        // =======History Table======================

   
        //Total Amount Calculations
        $daysworked=$request->input('daysworked');
        $monthlyrate=$request->input('bsalary');

        $grosssalary=$closedaysworked*$monthlyrate;
        $ttsalary=$grosssalary+$dsaamount;

        $history = new History;
        $history->employee_name = $request->name;
        $history->employee_id=$id;
        $history->ctgnumber=$request->ctgnumber;
        $history->bsalary=$request->bsalary ?? "0";
        $history->daysworked=$closedaysworked ?? "0";
        $history->inland=$request->inland ?? "0";
        $history->overland=$request->overland ?? "0";
        $history->sickleave=$request->sickleave ?? "0";
        $history->annualleave=$request->annualleave ?? "0";
        $history->ot15=$ot15;
        $history->ot175=$ot175;
        $history->ot2=$ot2;
        $history->ot25=$ot25;
        $history->dsainland=$indsa;
        $history->dsaoverland=$ovedsa;
        $history->dsaamount=$dsaamount;
        $history->ttsalary=$ttsalary; 
        $history->batch=$request->batch;    
        $history->save();
        
        Alert::success('Success','Payment Records has been created successfully !');
        Session::flash('Success','Payment Records has been created successfully !');
        return redirect()->route('payments_list');
        }

        
    }

    public function payments()
    {     
        $end = new Carbon('last day of this month');  
        return view('admin.payment.payment_list')->with([
            'payments'=> Payment::all(),
            'employees'=> Employee::all(),
            'end'=>$end            
        ]);  
        
    }

    public function salary(){

        return view('admin.payment.salary');        
    }

    public function paylist(){
        if(request()->ajax()) {

            if(!empty($request->from_date)) {

                $data = DB::table('histories')
                    ->whereBetween('created_at', array($request->from_date, $request->to_date))
                    ->get();

            } else {
                $data = DB::table('histories')
                    ->get();

            }

            return datatables()->of($data)->make(true);
        }

        return view('admin.payment.history');
    
    }

}
