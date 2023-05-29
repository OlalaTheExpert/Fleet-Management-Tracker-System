

@extends('layouts.master')

@section('css')
<!--Chartist Chart CSS -->
<link rel="stylesheet" href="{{ URL::asset('plugins/chartist/css/chartist.min.css') }}">
@endsection

@section('breadcrumb')
<div class="col-sm-6 text-left" >
     <h4 class="page-title">Vehicle Details</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">Welcome to Fleet Time Management Tracker</li>
     </ol>
</div>
@endsection

@section('content')
<!-- Edit -->
           
            <h4 class="modal-title"><b><span class="employee_id">Change Password for {{ $user->fullname }}</span></b></h4>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('password.edit', $user->id) }}">
                    @csrf
                    @method('PUT')
                    {{-- <input type="hidden" name="_method" value="PATCH"> --}}
                    <div class="form-group">                                        

                    <div id="div_id_name" class="form-group required"> 
                        <label for="id_name" class="control-label col-md-4  requiredField"> User Details<span class="asteriskField">*</span> </label> 
                        <div class="controls col-md-8 "> 
                            <input type="text" class="input-md textinput textInput form-control" id="type" name="type" value="{{ $vehicle->type }}"
                            required>
                        </div>
                    </div> 
                    <div id="div_id_name" class="form-group required"> 
                        <label for="id_name" class="control-label col-md-4  requiredField"> Username<span class="asteriskField">*</span> </label> 
                        <div class="controls col-md-8 "> 
                            <input type="text" class="input-md textinput textInput form-control" id="model" name="model" value="{{ $user->name }}"
                            required>
                        </div>
                    </div>
                    <div id="div_id_name" class="form-group required"> 
                        <label for="id_name" class="control-label col-md-4  requiredField">New Password <span class="asteriskField">*</span> </label> 
                        <div class="controls col-md-8 "> 
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div id="div_id_name" class="form-group required"> 
                        <label for="id_name" class="control-label col-md-4  requiredField">Confirm Password <span class="asteriskField">*</span> </label> 
                        <div class="controls col-md-8 "> 
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    
      
            </div>
            <div class="form-group"> 
                <div class="aab controls col-md-4 "></div>
                <div class="controls col-md-8 ">
                    <button type="submit" class="btn btn-primary btn btn-info" name="edit">Update</button>
                    
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
