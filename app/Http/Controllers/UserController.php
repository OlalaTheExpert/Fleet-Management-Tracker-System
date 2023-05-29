<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Station;
use App\Models\Position;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use \Validator;
use DB;

// use\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;



class UserController extends Controller
{
    public function index(){       
        $user=User::all(); 
        $employee=Employee::all();  
                    
        return view('admin.users.index', ['users'=>$user, 'employees'=>$employee]);
       
    }

   
    public function create(Request $request) { 
        $id=$request->id;
        $user=Employee::find($id);
        $email=Employee::select('email')->where('id', $id)->first(); 
        $station_id=Employee::select('station_id')->where('id', $id)->first();        
        $fullname=Employee::select('name')->where('id',$id)->first();
        $user_email=$email->email;
        $user_name=$fullname->name;
        $stat_id=$station_id->station_id;
    
        $input['email'] = Request('email');
        $rules = array(
            'email' => 'unique:users,email'
            
        );
         $message = [
            'password.confirmed' => 'The :attribute does not match',
            'email'=>'The :attribute already exist'
        ];
        $validator = Validator::make($input, $rules);

      if($validator->fails()){
        Alert::success('Warning','Failed, user exist !');
        Session::flash('Warning','Failed, user exist !');
        return redirect()->back();
      }else{
        
        User::create([
            'name' => $user_name,
            'email' => $user_email,            
            'role' => $request['role'],
            'fullname' => $user_name,
            'employee_id'=>$id,
            'station_id'=>$stat_id,
            'remember_token' => Str::random(10),
            'password' => Hash::make($request['password']),
        ]);
        
        if($request['role']== '0'){
            $employee=Employee::where('id', $id)->update([
                'account_stat'=>'1',
                'permissions'=>'1',
                'stat'=>'0'
            ]);
        }else{
            $employee=Employee::where('id', $id)->update([
                'account_stat'=>'1',
                'permissions'=>'1',
                'stat'=>'1'
            ]);
        }
                
         
        Alert::success('Success','User created successfully !');
        Session::flash('Success','User created successfully !');
        return redirect()->back();
        // $user->save();

    }
} 

    

    public function updatepassword(Request $request, $id){

        $user=User::find($id);  
        return view('admin.users.edit-password', ['user'=>$user]);
    }
    public function editpassword(Request $request, $id){

        $user=User::find($id);
        
        
        $this->validate($request, [
            'name' => ['required','regex:/^\S*$/u', 'string', 'max:255'],
             'password' => ['required', 'string', 'min:8', 'confirmed'],
             'password_confirmation' => ['required', 'string', 'min:8'],             
             
             
         ]);
      
         $message = [
            'password.confirmed' => 'The :attribute does not match',
            'name.regex:/^\S*$/u'=>'The :attribute should not contain white spaces'

            
        ];
                
        User::find($id)->update([
            'name' => $request['name'],
            'remember_token' => Str::random(10),
            'password' => Hash::make($request['password'])
        ]
            );             

        Session::flash('Success', 'Password Changed successfully !');        
        return redirect()->route('users');
        //return redirect()->back();
        
    }

    public function youreditpassword(Request $request){

       
        $user = auth()->user()->id;
        
        $this->validate($request, [
            'name' => ['required','regex:/^\S*$/u', 'string', 'max:255'],
             'password' => ['required', 'string', 'min:8', 'confirmed'],
             'password_confirmation' => ['required', 'string', 'min:8'],             
             
             
         ]);
      
         $message = [
            'password.confirmed' => 'The :attribute does not match',
            'name.regex:/^\S*$/u'=>'The :attribute should not contain white spaces'

            
        ];
                
        User::find($user)->update([
            'name' => $request['name'],
            'remember_token' => Str::random(10),
            'password' => Hash::make($request['password'])
        ]
            );             

            //dd('test');
        Alert::success('Success','Password Changed successfully !');              
        return redirect()->route('updatepassword');
        //return redirect()->back();
        
    }

    public function block($id){
        $user=User::find($id);
        $user->permissions='0';
        $user->update();
        $employee_id=User::select('employee_id')->where('id', $id)->first();
        $employee=Employee::where('id', $employee_id)->update([
            'account_stat'=>'0',
           
            
        ]);
        Session::flash('message', 'User Blocked !');   
        return redirect()->back();
    }
    public function unblock($id){
        $user=User::find($id);
        $user->permissions='1';
        $user->update();        
        $employee_id=User::select('employee_id')->where('id', $id)->first();
        $employee=Employee::where('id', $employee_id)->update([
            'account_stat'=>'1',            
            
        ]);
        Session::flash('Success', 'User unblocked !');   
        return redirect()->back();
    }

   
}
// }