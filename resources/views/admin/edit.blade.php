

@extends('layouts.master')

@section('css')
<!--Chartist Chart CSS -->
<link rel="stylesheet" href="{{ URL::asset('plugins/chartist/css/chartist.min.css') }}">
@endsection

@section('breadcrumb')
<div class="col-sm-6 text-left" >
     <h4 class="page-title">Dashboard</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">Welcome to Fleet Time Management Tracker</li>
     </ol>
</div>
@endsection

@section('content')
<!-- Edit -->

 
           
            <h4 class="modal-title"><b><span class="employee_id">Edit Employee</span></b></h4>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('admin.update', $employee->id) }}">
                    @csrf
                    @method('PUT')
                    {{-- <input type="hidden" name="_method" value="PATCH"> --}}
                    <div class="form-group">
                        {{-- <label for="name" class="col-sm-3 control-label">Name</label>


                        <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}"
                            required>

                    </div> --}}

                    <div id="div_id_name" class="form-group required"> 
                        <label for="id_name" class="control-label col-md-4  requiredField"> Name<span class="asteriskField">*</span> </label> 
                        <div class="controls col-md-8 "> 
                            <input type="text" class="input-md textinput textInput form-control" id="name" name="name" value="{{ $employee->name }}"
                            required>
                            </div>
                    </div>
                    <div id="div_id_name" class="form-group required"> 
                        <label for="id_name" class="control-label col-md-4  requiredField"> CTG Number<span class="asteriskField">*</span> </label> 
                        <div class="controls col-md-8 "> 
                            <input type="text" class="input-md textinput textInput form-control" id="ctgnumber" name="ctgnumber"
                            value="{{ $employee->ctgnumber }}">
                        </div>
                    </div>
                    {{-- <div id="div_id_name" class="form-group required"> 
                        <label for="id_name" class="control-label col-md-4  requiredField"> Daily Rates (USD)<span class="asteriskField">*</span> </label> 
                        <div class="controls col-md-8 "> 
                            <input type="number" class="input-md textinput textInput form-control" id="bsalary" name="bsalary" value="{{ $employee->bsalary }}"
                            required>
                            </div>
                    </div> --}}

                    <div id="div_id_name" class="form-group required"> 
                        <label for="schedule" class="col-md-4 control-label">Position</label>

                        <div class="controls col-md-8 "> 
                        <select class="form-control col-md-12" id="position" name="position" required>
                            <option value="{{ $employee->position_id}}" selected>{{ $employee->position}}</option>
                            @foreach($positions as $position)
                            <option value="{{$position->id}}">{{$position->position}}  </option>
                            @endforeach

                        </select>
                        </div> 

                    </div>
                    <div id="div_id_name" class="form-group required"> 
                        <label for="schedule" class="col-md-4 control-label">Duty Station</label>

                        <div class="controls col-md-8 "> 
                        <select class="form-control col-md-12" id="station" name="station" required>
                            <option value="{{ $employee->station_id}}" selected>{{ $employee->station_name}}</option>
                            @foreach($stations as $station)
                            <option value="{{$station->id}}">{{$station->station}}  </option>
                            @endforeach

                        </select>
                        </div> 

                    </div>

                    <div id="div_id_name" class="form-group required"> 
                        <label for="id_name" class="control-label col-md-4  requiredField"> Email<span class="asteriskField">*</span> </label> 
                        <div class="controls col-md-8 "> 
                            <input type="text" class="input-md textinput textInput form-control" id="email" name="email"
                            value="{{ $employee->email }}">
                        </div>
                    </div>
             </div>
            <div class="form-group"> 
                <div class="aab controls col-md-4 "></div>
                <div class="controls col-md-8 ">
                    <button type="submit" class="btn btn-primary btn btn-info" name="edit">Post</button>
                    {{-- <input type="submit" name="Signup" value="Signup" class="btn btn-primary btn btn-info" id="submit-id-signup" /> --}}
                    {{-- or <input type="button" name="Signup" value="Sign Up with Facebook" class="btn btn btn-primary" id="button-id-signup" /> --}}
                </div>
            </div> 
        </form>
      

@endsection

@section('script')
<!--Chartist Chart-->
<script src="{{ URL::asset('plugins/chartist/js/chartist.min.js') }}"></script>
<script src="{{ URL::asset('plugins/chartist/js/chartist-plugin-tooltip.min.js') }}"></script>
<!-- peity JS -->
<script src="{{ URL::asset('plugins/peity-chart/jquery.peity.min.js') }}"></script>
<script src="{{ URL::asset('assets/pages/dashboard.js') }}"></script>
@endsection
