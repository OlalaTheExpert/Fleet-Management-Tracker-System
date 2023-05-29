

@extends('layouts.master')

@section('css')
<!--Chartist Chart CSS -->
<link rel="stylesheet" href="{{ URL::asset('plugins/chartist/css/chartist.min.css') }}">
@endsection

@section('breadcrumb')
<div class="col-sm-6 text-left" >
     <h4 class="page-title">Assign Roles</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">Welcome to Fleet Time Management Tracker</li>
     </ol>
</div>
@endsection

{{-- <style>
    .hidden{
visibility: hidden;
    }
</style> --}}

@section('content')
<!-- Edit -->
           
            <h4 class="modal-title"><b><span class="employee_id">Assign Role to {{ $employee->name }}</span></b></h4>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('driverrole.edit', $employee->id) }}">
                    @csrf
                    @method('PUT')
                    {{-- <input type="hidden" name="_method" value="PATCH"> --}}

                    <div class="form-group">
                        <label for="schedule" class="col-sm-3 control-label">Vehicle</label>
                        <select class="form-control col-lg-8" id="vehicle_id" name="vehicle_id" required>
                            <option value="" selected>- Select Vehicle-</option>
                            @foreach($vehicles as $vehicle)
                            <option value="{{$vehicle->id}}">{{$vehicle->type}}::{{$vehicle->model}}::{{$vehicle->plateno}} </option>
                            @endforeach
                        </select> 
                    </div>
                    {{-- <div class="form-group hidden">
                        <label for="schedule" class="col-sm-3 control-label">Mission</label>
                        <select class="form-control col-lg-8" id="mission" name="mission" required>
                            <option value="Mission" selected>- Select Mission -</option>
                            
                            <option value="Inland">Inland Mission</option>
                            <option value="Overland">Overland Mission</option>
                            
                        </select> 
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="schedule" class="col-sm-3 control-label">Duty Station</label>
                        <select class="form-control col-lg-8" id="station_id" name="station_id" required>
                            <option value="" selected>- Select Duty Station -</option>
                            @foreach($stations as $station)
                            <option value="{{$station->id}}">{{$station->station}} </option>
                            @endforeach
                        </select> 
                    </div> --}}

            <div class="form-group"> 
                <div class="aab controls col-md-4 "></div>
                <div class="controls col-md-8 ">
                    <button type="submit" class="btn btn-primary btn btn-info" name="edit">Assign</button>
                    
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
