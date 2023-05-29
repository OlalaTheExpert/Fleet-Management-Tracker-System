<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee;
use App\Http\Controllers\Payment;
// use App\Http\Controllers\Upload;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DateRangeController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::group(['namespace' => 'App\Http\Controllers'], function()
// { 

// });
   
    //     Route::group(['middleware' => ['auth', 'permission']], function() {
    // Route::group(['prefix' => 'Admin', 'middlewareGroups' => ['role:Admin', 'web']], function () {
    

// Route::group(['middleware' => ['auth']], function() {
//     Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
// });
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();

Route::PUT('/upload/{id}', [App\Http\Controllers\UploadController::class, 'approve'])->name('upload.approve');
Route::PUT('/upload/reject/{id}', [App\Http\Controllers\UploadController::class, 'comment'])->name('comment');
Route::get('/upload', '\App\Http\Controllers\UploadController@index')->name('upload');
Route::POST('/upload/store', '\App\Http\Controllers\UploadController@uploads')->name('uploads');
Route::get('download/{id}', [App\Http\Controllers\UploadController::class, 'downloadFile'])->name('student.download');

Route::get('/overtime', '\App\Http\Controllers\LeaveController@indexOvertime')->name('indexOvertime');
Route::POST('/overtime/Update', '\App\Http\Controllers\LeaveController@overTimeStore')->name('overTimeStore');


Route::group(['middleware' => ['auth']], function() {
    //Attendance Checklist
    Route::resource('/schedule', '\App\Http\Controllers\ScheduleController');
    Route::get('/check', '\App\Http\Controllers\CheckController@index')->name('check');
    Route::get('/sheet-report', '\App\Http\Controllers\CheckController@sheetReport')->name('sheet-report');
    Route::post('check-store','\App\Http\Controllers\CheckController@CheckStore')->name('check_store');
    //Leave
    Route::get('/leave', '\App\Http\Controllers\LeaveController@index')->name('leave');
    Route::get('/leave/assign', function () {
        return view('attendance_leave_login');
    })->name('leave.login');

    Route::PUT('Check/{id}', [App\Http\Controllers\CheckController::class, 'days'])->name('days');
//Edited
    Route::POST('Attendance_Tracker/filter', [App\Http\Controllers\CheckController::class, 'filter'])->name('trackerfilter');

    Route::POST('schedule/filtered_data', [App\Http\Controllers\ScheduleController::class, 'filter'])->name('filter');

    Route::GET('schedule/{schedule}', [App\Http\Controllers\ScheduleController::class, 'update'])->name('schedule.update');
    Route::DELETE('schedule/{schedule}', [App\Http\Controllers\ScheduleController::class, 'destroy'])->name('schedule.destroy');
    Route::resource('/schedule', '\App\Http\Controllers\ScheduleController');

    Route::POST('/Schedule/Mission days', [App\Http\Controllers\ScheduleController::class, 'sundaystore'])->name('schedule.sundaystore');
    Route::get('/Schedule/Calendar', [App\Http\Controllers\ScheduleController::class, 'calendar'])->name('calendar');
    Route::post('calendar-crud-ajax', [App\Http\Controllers\ScheduleController::class, 'calendarEvents'])->name('calendarEvents');

    Route::POST('/Employees/Leaves', [App\Http\Controllers\LeaveController::class, 'leavestore'])->name('leaves.store');

    Route::get('/Employee/Dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('employeedashboard');
    Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/duty-stations/employees', [App\Http\Controllers\EmployeeController::class, 'stationemployees'])->name('stationemployees');
    Route::get('/Employee/Profile', [App\Http\Controllers\EmployeeController::class, 'profile'])->name('profile');
    Route::resource('daterange', DateRangeController::class);
    Route::resource('employee', EmployeeController::class);
    Route::get('/Clerk/edit', [App\Http\Controllers\EmployeeController::class, 'clerkpassword'])->name('clerkpassword');
    Route::get('/user/edit', [App\Http\Controllers\EmployeeController::class, 'password'])->name('password');
    Route::PUT('/user/update/{id}', [App\Http\Controllers\EmployeeController::class, 'uppassword'])->name('uppassword');
    Route::POST('/user-password/update/', [App\Http\Controllers\EmployeeController::class, 'changePasswordPost'])->name('changePasswordPost');
    Route::get('/Employees', [
        'as' => 'stationempl',
    'uses' => 'App\Http\Controllers\EmployeeController@stationempl']);
    Route::get('/Employees-list', [App\Http\Controllers\EmployeeController::class, 'stationemplist'])->name('stationemplist');
    Route::POST('/Employees-list', [App\Http\Controllers\EmployeeController::class, 'stationstore'])->name('employees.stationstore');
    Route::get('/Employees Update/{id}', [App\Http\Controllers\EmployeeController::class, 'employeestationedit'])->name('employeestationedit');
    
    Route::PUT('Employees Edit/{id}', [App\Http\Controllers\EmployeeController::class, 'employeestationupdate'])->name('employeestationupdate');
    // Route::post('login', array( 'uses'=>'App\Http\Controllers\EmployeeController@postLogin') );
    Route::get('/station employees/delete/{id}', [App\Http\Controllers\EmployeeController::class, 'destroystationempl'])->name('destroystationempl');
   
});

   
    Route::get('/User_Password/details/{id}', [App\Http\Controllers\UserController::class, 'updatepassword'])->name('updatepassword'); 
    Route::resource('/employees', '\App\Http\Controllers\EmployeeController');
    Route::get('/employees/edit/{id}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('admin.edit');
    Route::PUT('/employees/update/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('admin.update');
    Route::get('/employees/delete/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employees.destroy');
   


    Route::group(['middleware' => ['auth']], function () {

    Route::get('/duty-stations/employees', [App\Http\Controllers\EmployeeController::class, 'stationemployees'])->name('stationemployees');

});

    //Route::resource('/uploads', 'App\Http\Controllers\UploadController::class');
    
    


    // Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    // =======Staffs URLs Role to Data Clerk==========
    Route::resource('/employees', '\App\Http\Controllers\EmployeeController');
    Route::get('/employees/edit/{id}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('admin.edit');
    Route::PUT('/employees/update/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('admin.update');
    Route::get('/employees/delete/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employees.destroy');
   
    //=========Payment====
    //edited
    
    Route::POST('/payment/payroll_filter', [App\Http\Controllers\PaymentController::class, 'payrollfilter'])->name('payrollfilter');
    Route::get('/sheet-report', '\App\Http\Controllers\CheckController@sheetReport')->name('sheet-reportall');
    Route::get('/sheet-report/{id}', '\App\Http\Controllers\CheckController@sheetReport')->name('sheet-report');
    Route::get('/employees/payment-updates/{id}', [App\Http\Controllers\PaymentController::class, 'index'])->name('payment.updates');
    Route::PUT('/employees/payment-details/{id}', [App\Http\Controllers\PaymentController::class, 'store'])->name('payment.details');
    Route::get('/payments/payment-details', [App\Http\Controllers\PaymentController::class, 'payments'])->name('payments_list');
    Route::get('/payments/details', [App\Http\Controllers\PaymentController::class, 'updateall'])->name('paymentall'); 
    Route::get('/payments/details/{id}', [App\Http\Controllers\PaymentController::class, 'update'])->name('payment.done'); 
    Route::PUT('/payments/edit/{id}', [App\Http\Controllers\PaymentController::class, 'edit'])->name('payment.edit');
    Route::get('/salary/updates', [App\Http\Controllers\PaymentController::class, 'salary'])->name('payment.salary');
    Route::get('/payments/History', [App\Http\Controllers\PaymentController::class, 'paylist'])->name('paylist');
      //=============Drivers===============
      Route::get('/drivers', [App\Http\Controllers\DriverController::class, 'index'])->name('drivers');
      Route::get('/drivers/update/{id}', [App\Http\Controllers\DriverController::class, 'update'])->name('drivers.update'); 
      Route::PUT('/drivers/edit/{id}', [App\Http\Controllers\DriverController::class, 'edit'])->name('drivers.edit');
      Route::get('/drivers/delete/{id}', [App\Http\Controllers\DriverController::class, 'delete'])->name('drivers.delete');
      
      //============Driver roles============
      Route::get('/driverlogs', [App\Http\Controllers\DriverController::class, 'driverlogs'])->name('driverlogs');
      Route::get('/driver-role/update/{id}', [App\Http\Controllers\DriverController::class, 'updaterole'])->name('driverrole.update'); 
      Route::PUT('/driver-role/edit/{id}', [App\Http\Controllers\DriverController::class, 'driverrole'])->name('driverrole.edit');
      Route::get('/drivers/delete/{id}', [App\Http\Controllers\DriverController::class, 'deleterole'])->name('drivers.delete');
      


        Route::group(['middleware' => ['auth', 'isAdmin']], function() {   
    
//=====Job Position URLs=========
        Route::get('/staffs/positions', [App\Http\Controllers\PositionController::class, 'index'])->name('positions');
        Route::POST('/position/add-job-group', [App\Http\Controllers\PositionController::class, 'store'])->name('positions.store'); 
        Route::get('/position/update/{id}', [App\Http\Controllers\PositionController::class, 'update'])->name('positions.update'); 
        Route::PUT('/position/edit/{id}', [App\Http\Controllers\PositionController::class, 'edit'])->name('positions.edit');
        Route::get('/position/delete/{id}', [App\Http\Controllers\PositionController::class, 'delete'])->name('positions.delete'); 
        Route::get('/User_Password/details/{id}', [App\Http\Controllers\UserController::class, 'updatepassword'])->name('updatepassword'); 
   
        // ========Vehicle Routes========
        Route::get('/vehicles', [App\Http\Controllers\VehicleController::class, 'index'])->name('vehicles');
        Route::POST('/vehicles/add-details', [App\Http\Controllers\VehicleController::class, 'store'])->name('vehicles.store');
        Route::get('/vehicles/update/{id}', [App\Http\Controllers\VehicleController::class, 'update'])->name('vehicles.update'); 
        Route::PUT('/vehicles/edit/{id}', [App\Http\Controllers\VehicleController::class, 'edit'])->name('vehicles.edit');
        Route::get('/vehicles/delete/{id}', [App\Http\Controllers\VehicleController::class, 'delete'])->name('vehicles.delete');
        
      
        //============Duty Stations===============
        Route::get('/duty-stations', [App\Http\Controllers\StationController::class, 'index'])->name('stations');
        Route::get('/duty-stations-incharge', [App\Http\Controllers\StationController::class, 'stationsincharge'])->name('stationsincharge');
        Route::POST('/duty-stations/add-details', [App\Http\Controllers\StationController::class, 'store'])->name('stations.store');
        Route::get('/duty-stations/update/{id}', [App\Http\Controllers\StationController::class, 'update'])->name('stations.update'); 
        Route::PUT('/duty-stations/edit/{id}', [App\Http\Controllers\StationController::class, 'edit'])->name('stations.edit');
        Route::get('/duty-stations/delete/{id}', [App\Http\Controllers\StationController::class, 'delete'])->name('stations.delete');
    
     
        //=====Users===========
        Route::get('/Users-Managment', [App\Http\Controllers\UserController::class, 'index'])->name('users');
        Route::POST('/Users-Managment', [App\Http\Controllers\UserController::class, 'create'])->name('adduser');
       
        Route::PUT('/User/edit/{id}', [App\Http\Controllers\UserController::class, 'editpassword'])->name('password.edit');
        Route::get('/User/block/{id}', [App\Http\Controllers\UserController::class, 'block'])->name('block');
        Route::get('/User/unblock/{id}', [App\Http\Controllers\UserController::class, 'unblock'])->name('unblock');
        Route::get('/User/details/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('update-user-details'); 
        Route::PUT('/User/edit-user/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('edit-user-details');
    });



    



  


        

