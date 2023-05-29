

@extends('layouts.master')

@section('css')
<!--Chartist Chart CSS -->
<link rel="stylesheet" href="{{ URL::asset('plugins/chartist/css/chartist.min.css') }}">
@endsection

@section('breadcrumb')
<div class="col-sm-6 text-left" >
     <h4 class="page-title">User Details</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">Welcome to Fleet Time Management Tracker</li>
     </ol>
</div>
@endsection

@section('content')
<!-- Edit -->
@if(Session::has('message'))
<div class="alert alert-danger">
  {{Session::get('message')}}
</div>
@elseif(session('Success'))
<div class="alert alert-success">
  {{Session::get('Success')}}
</div>
@endif
            <h4 class="modal-title"><b><span class="employee_id">Change your Password </span></b></h4>
            <div class="modal-body text-left">
                <form method="POST" action="{{route('changePasswordPost', auth()->user()->id)}}">
                    @csrf
                    @method('POST')
                    <div class="form-group col-md-6">
                        <label>Old password </label>
                        <input type="password" name="current-password" id="current-password" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>New password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>Confirm password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn" type="submit">Update Password</button>
                    </div>
                </form>
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
