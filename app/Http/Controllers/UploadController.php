<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use App\Models\Schedule;
use App\Models\Employee;
use App\Models\Check;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use \Validator;
use DB;
use Hash;
use Auth;
use DateTime;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
// use\Auth;
use App\Http\Requests\ScheduleEmp;


class UploadController extends Controller
{
    public function index(Request $request)
    {

        //$employee_id = DB::table('uploads')->pluck('employee_id');
     
        // $schedule=DB::table('uploads')       
        // ->whereDate('created_at',  Carbon::today()->toDateString())     
        // ->get();

        $upload=Upload::all();

        

       
        return view('admin.attendance.upload')->with(['uploads'=>$upload, 'employees'=>Employee::all() ]);
        flash()->success('Success','Schedule has been created successfully !');
      // dd("TEST");
       // return view('admin.attendance.upload');

    
}

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

     public function uploads(Request $request)

     {
 
        $request->validate([
            'files' => 'required',
            'files.*' => 'required|mimes:pdf,xlx,csv,xlsx,jpg,png,jpeg',
        ]);
      
        $files = [];
        if ($request->file('files')){
            foreach($request->file('files') as $key => $file)
            {
                $fileName = time().rand(1,99).'.'.$file->extension();  
                $file->move(public_path('uploads'), $fileName);
                $uploaded_by=(Auth::user()->name);
                $station=(Auth::user()->station_id);
                $files[]=[
                    'file_name'=>$fileName,
                    'uploaded_by'=>$uploaded_by,
                    'station_id'=>$station,
                    'status'=>'0'
                ];
                // $files[]['uploaded_by'] = 'Olala';
            }
        }
  
        foreach ($files as $key => $file) {
            Upload::create($file);
        }
     
        return back()
                ->with('success','You have successfully upload file.');
   
    }

    public function downloadFile($id){
        $path = Upload::where("id", $id)->value("file_name");
        $file1='uploads'.$path;
        //return Storage::download($file);        
        // $file = public_path(). $file1;
        $file = public_path(). "/uploads/$path";
        $headers = ['Content-Type: image/jpeg'];
        if (file_exists($file)) {
            return \Response::download($file);
        } else {
            return back()
            ->with('message','File not found.');
            //dd('File not found.' .$file);
        }
       
        //dd($path);
      }

      public function approve(Request $request, $id)
      {
        $upload=Upload::find($id);
        $upload->status='1';
        $upload->approved_by=$request->user;        
        $upload->update(); 
        
        return back()
                ->with('success','Approved successfully.');
   
      }

      public function comment(Request $request, $id)
      {
        $upload=Upload::find($id);
        $upload->status='0';
        $upload->comment=$request->comment;
        $upload->approved_by=$request->user;        
        $upload->update(); 
        
        return back()
                ->with('success','Comment posted successfully.');
   
      }
}
