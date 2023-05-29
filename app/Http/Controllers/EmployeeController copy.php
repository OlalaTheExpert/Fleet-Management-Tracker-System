<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Payment;
use App\Models\Role;
use App\Models\Check;
use App\Models\Station;
use App\Http\Requests\EmployeeRec;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use \Validator;
use DB;
use Hash;
use Auth;
// use\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;


class EmployeeController extends Controller
{
    
   
    public function index()
    {

        $user = auth()->user();       
       
        if($user->role=='Data-Clerk' || $user->role=='1'){

            
            // return view('admin.employee')->with([
            //     'employees'=> Employee::all(), 
            //     'positions'=>Position::all(),
            //     'users'=>$user,
            //     'stations'=>Station::all()
            // ]);

            if(request()->ajax()) {

                if(!empty($request->from_date)) {
    
                    $data = DB::table('employees')
                        ->whereBetween('created_at', array($request->from_date, $request->to_date))
                        ->get();
    
                } else {
    
                    $data = DB::table('employees')
                        ->get();
    
                }
    
                return datatables()->of($data)->make(true);
            }
    
            return view('admin.employee')->with([
                    'employees'=> Employee::all(), 
                    'positions'=>Position::all(),
                    'users'=>$user,
                    'stations'=>Station::all()
                ]);
            
            
        }else{
            if($user->role=='0'){            
                Session::flash('Success','You are logged in as Employee');
            }else{
                Session::flash('Success','You are logged in as Duty Station Incharged');
            }

            return redirect()->route('admin');
           
        }

           
    }

    public function employeedashboard(){
        $user = auth()->user(); 
      $data=User::with('getEmployee')->get();
        return view('admin.employee-dashboard', ['data'=>$data]);
           
    }
    public function stationemployees(){
        $user = auth()->user();
        // $members=Employee::find('');
        // $members->r  

        // $employees = Employee::with('emp_employee')->get();
        $employees = Employee::with('station')->get();
        // $vehicles = Vehicle::with('employee')->get();
        $stations = Station::with('emp_employee')->get();
        $positions=Position::all();   
        return view('admin.stations.stattion-members', compact('employees', 'positions', 'stations'));

       
    }

    public function store(Request $request)
    {
        
        $user = auth()->user();       
  
        // Get the value from the form
        //$input['email'] = Request('email');
        $input['ctgnumber'] = Request('ctgnumber');

        // Must not already exist in the `email` column of `users` table
        // $rules = array(
        //     'email' => 'unique:employees,email'
            
        // );
        $rules1 = array(
            
            'ctgnumber'=>'unique:employees,ctgnumber'
        );

        $validator1=Validator::make($input, $rules1);

        //$validator = Validator::make($input, $rules);

        // if ($validator->fails()) {
        //     Alert::error('Warning','Employee with the email address already exist !');
            
        //     return redirect()->route('employees.index');
        // }else 
        if($validator1->fails()){
            Alert::error('Warning','The CTG Number already exist !');
            // Session::flash('Warning','Employee with the email address already exist !');
            return redirect()->route('employees.index');
        }
        else {
            $station=Station::select('station')->where('id', $request->station)->first();
            $station_name=$station->station;

            $daily=Position::select('daily_rates')->where('id', $request->position)->first();
            $daily_rates=$daily->daily_rates;
            $monthly=Position::select('monthly_rates')->where('id', $request->position)->first();
            $monthly_rates=$monthly->monthly_rates;
            $jobgroup=Position::select('position')->where('id', $request->position)->first();
            $positions=$jobgroup->position;

            $employee = new Employee;
            $employee->name = $request->name;
            $employee->vehicle_id = 0;
            $employee->mission = 0;
            $employee->permissions = 0;
            $employee->stat = 0;
            $employee->position = $positions;
            $employee->email = $request->email ?? "No Email account";
            $employee->ctgnumber = $request->ctgnumber;
            $employee->station_id = $request->station;
            $employee->station_name = $station_name;
            $employee->unit = $request->unit;
            $employee->bsalary = $daily_rates;
            $employee->monthly_rates = $monthly_rates;
            $employee->position_id=$request->position;
            $employee->pin_code = bcrypt($request->pin_code);
            $employee->save();

          
            
            Alert::success('Success','Employee Record has been created successfully !');
            Session::flash('Success','Employee Record has been created successfully !');
            return redirect()->route('employees.index');
        }
  
    //}      
            
// }else{
//     $userempl=$user->role=='0';
//     $userempl="Employee";
//     Session::flash('Success','You are logged in as ' .$userempl );
//     return redirect()->route('admin');
   
// }
      
    }

 
    public function update($id)
    {

        $user = auth()->user();  
       
            
        $employee=Employee::find($id);
        // $employee = new Employee;
        // $employee=Employee::find($id);
        return view('admin.edit', ['employee'=>$employee, 'positions'=>Position::all()]);
      
        
    }

    public function edit(Request $request, $id)
    {
        $employee=Employee::find($id); 
        
        $daily=Position::select('daily_rates')->where('id', $request->position)->first();
        $daily_rates=$daily->daily_rates;
        $monthly=Position::select('monthly_rates')->where('id', $request->position)->first();
        $monthly_rates=$monthly->monthly_rates;
        $jobgroup=Position::select('position')->where('id', $request->position)->first();
        $positions=$jobgroup->position;

        
        $employee->name = $request->name;
        $employee->position = $request->position;
        $employee->bsalary = $request->bsalary;
        $employee->email = $request->email ?? "No Email account";
        $employee->bsalary = $daily_rates;
        $employee->monthly_rates = $monthly_rates;
        $employee->position_id=$request->position;
        $employee->pin_code = bcrypt($request->pin_code);
        $employee->update();
        // $input['email'] = Request('email');
        // $rules = array(
        //     'email' => 'unique:employees,email'
            
        // );


       
        // $validator = Validator::make($input, $rules);

        // if ($validator->fails()) {
        //     Alert::error('Warning','Employee with the email address already exist !');
        
        //     return redirect()->route('employees.index');
        // }else{

        if (Payment::where('employee_id', '=', $id)->exists()) {
        $user=Payment::where('employee_id', $id)->update([
            'bsalary'=> $request->bsalary
           ]); 
        }

        Session::flash('Success', 'Employee Record has been Updated successfully !');
        // Session::flash('post-created-message', 'Post was Created Successfully');
        return redirect()->route('employees.index');       
        
        
    }


    public function destroystationempl($id){

        $employee=Employee::find($id);
        $employee->delete();
        
        
        // if (request()->wantsJson()) {
        //     return response([], 204);
        // }
        Alert::success('Success','Employee Record has been removed successfully !');
        return redirect()->route('stationempl')->with('success');
    }
   
    public function destroy($id){

        $employee=Employee::find($id);
        $employee->delete();

        $user=Payment::where('employee_id', $id)->delete();
       

        Alert::success('Success','Employee Record has been removed successfully !');
        return redirect()->route('employees.index')->with('success');
    }

    public function profile()
    {      
        $user = auth()->user(); 
        //    $data= User::with('getEmployee')->get();
        //       return view('admin.employee-dashboard', ['user'=>$data]);
        $user_id=auth()->user()->employee_id;
        $data= DB::table('employees')
        ->join('payments', 'employee_id', "=", 'employees.id')
        ->where('employees.id', $user_id)
        ->get();
        $data1= DB::table('employees')       
        ->where('id', $user_id)
        ->get();

        $employees = Employee::with('station')->get();

        if($data->isEmpty()){
            return view('admin.user-profile2', ['user'=>$data1, 'employee'=>$employees]);
        }else{
// $station=Station::find($data->station_id);
        return view('admin.user-profile', ['user'=>$data, 'employee'=>$employees]); 
        }

        
        
        
    }
   


    public function uppassword(Request $request, $id){

        $employee=Employee::find($id);        
        // $employee->position = $request->position;        
        // $employee->pin_code = bcrypt($request->pin_code);
        $employee->name=$request->name;
        $employee->phone_number=$request->phone_number;
        $employee->email=$request->email;
        $employee->gender=$request->gender;
         
        $input['email'] = Request('email');
        $rules = array(
            'email' => 'unique:users,email'
            
        );
        
        $validator = Validator::make($input, $rules);
        
        if ($validator->fails()) {
            Alert::error('Warning','Choose a unique email !');
            // Session::flash('Warning','Employee with the email address already exist !');
            return redirect()->route('profile');
        }else{
        $employee->update(); 
        $user=User::where('employee_id', $id)->update([
            'email'=>Request('email'),
            'name'=>Request('name')
           
        ]);
        Session::flash('Success', 'Your profile updated successfully !');        
        return redirect()->route('profile');
    }
        
    }

    public function password(Request $request){

        // $position=Position::find($id);  
        // return view('admin.edit-position', ['position'=>$position]);
        return view('admin.change-password');
    }
    public function clerkpassword(Request $request){

        // $position=Position::find($id);  
        // return view('admin.edit-position', ['position'=>$position]);
        return view('admin.users.userp');
    }

    public function changePasswordPost(Request $request){
        // User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
        // Session::flash('Success', 'Password changed successfully !'); 
        
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            Session::flash('message', 'Your current password does not matches with the Old Password!'); 
            return redirect()->back();
        }else{
            
        }     
        if(strcmp($request->get('current-password'), $request->get('password')) == 0){
            // Current password and new password same
            Session::flash('message', 'New Password cannot be same as your current password!'); 
            return redirect()->back();
        }else{

        $this->validate($request, [
            
             'password' => ['required', 'string', 'min:8', 'confirmed'],
             'password_confirmation' => ['required', 'string', 'min:8'],             
             
             
         ]);
         $message = [
            'password.confirmed' => 'The :attribute does not match'
                      
        ];
    
        //Change Password

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
        Session::flash('Success', 'Password changed successfully !'); 
        // dd('Password change successfully.');
        return redirect()->back();
        // return view('admin.change-password');
    }
    }


public function stationempl(Request $request){
    $user = auth()->user();
    $station= auth()->user()->station_id;          
    $user_id=auth()->user()->employee_id;
    $data= DB::table('employees')
    ->join('payments', 'employee_id', "=", 'employees.id')
    ->where('employees.id', $user_id)
    ->get();
    $users=User::all();
    $employees = Employee::with('station')->get();
   

    $employee = Employee::where('station_id',$station)->get();
    return view('station-admin.employee')->with([
        'employees'=>$employees,
        'employee'=> $employee, 
        'positions'=>Position::all(),
        'users'=>$user,
        'members'=>$users,
        'user'=>$data,
        'stations'=>Station::all()
    ]);
}

public function stationemplist(){
    $user = auth()->user();
    $station= auth()->user()->station_id;          
    $user_id=auth()->user()->employee_id;
    $data= DB::table('employees')
    ->join('payments', 'employee_id', "=", 'employees.id')
    ->where('employees.id', $user_id)
    ->get();
    $users=User::all();
    $employees = Employee::with('station')->get();

    $employee = Employee::where('station_id',$station)->get();
    $employee = Employee::where('station_id',$station)->get();
    return view('station-admin.employee-list')->with([
        'employees'=>$employees,
        'employee'=> $employee, 
        'positions'=>Position::all(),
        'users'=>$user,
        'members'=>$users,
        'user'=>$data,
        'stations'=>Station::all()
    ]);
}

public function stationstore(Request $request)
{
    
    $user = auth()->user();       
   
    // Get the value from the form
    $input['email'] = Request('email');

    // Must not already exist in the `email` column of `users` table
    $rules = array('email' => 'unique:employees,email');

    $validator = Validator::make($input, $rules);

    if ($validator->fails()) {
        Alert::error('Warning','Employee with the email address already exist !');
        // Session::flash('Warning','Employee with the email address already exist !');
        return redirect()->route('stationempl');
    }
    else {
        // $station=Station::select('station')->where('id', $request->station)->first();
        // $station_name=$station->station;
        $employee = new Employee;
        $employee->name = $request->station_name;
        $employee->name = $request->name;
        $employee->vehicle_id = 0;
        $employee->mission = 0;
        $employee->permissions = 0;
        $employee->stat = 0;
        $employee->position = $request->position;
        $employee->email = $request->email;
        $employee->ctgnumber = $request->ctgnumber;
        $employee->station_id = $request->station_id;        
        $employee->unit = $request->unit;
        $employee->bsalary = $request->bsalary;
        $employee->pin_code = bcrypt($request->pin_code);
        $employee->save();
        
        Alert::success('Success','Employee Record has been created successfully !');
        Session::flash('Success','Employee Record has been created successfully !');
        return redirect()->route('stationempl');
    }


  
}

public function employeestationupdate(Request $request, $id)
{
    $employee=Employee::find($id);      
    
    $employee->name = $request->name;
    $employee->position = $request->position;
    $employee->email = $request->email;
    $employee->ctgnumber = $request->ctgnumber;
    $employee->phone_number = $request->phone_number;
    $employee->bsalary = $request->bsalary;
    
    $employee->unit = $request->unit;
    $employee->pin_code = bcrypt($request->pin_code);
    
    $input['email'] = Request('email');
    $rules = array(
        'email' => 'unique:employees,email'
        
    );
    
    $validator = Validator::make($input, $rules);

    if ($validator->fails()) {
        Alert::error('Warning','Choose a unique email !');
        // Session::flash('Warning','Employee with the email address already exist !');
        return redirect()->route('stationempl');
    }else{
        $employee->update();
    Session::flash('Success', 'Employee Record has been Updated successfully !');
    // Session::flash('post-created-message', 'Post was Created Successfully');
    return redirect()->route('stationempl');
}
    
}
public function employeestationedit(Request $request, $id)
	{
        $employee=Employee::find($id);
        $position=Position::all();
        // $employee=Employee::find($id);
        return view('station-admin.edit-employee', ['employee'=>$employee, 'positions'=>$position]);
    
	}
   

}
