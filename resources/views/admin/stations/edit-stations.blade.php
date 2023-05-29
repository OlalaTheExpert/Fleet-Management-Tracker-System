

@extends('layouts.master')

@section('css')
<!--Chartist Chart CSS -->
<link rel="stylesheet" href="{{ URL::asset('plugins/chartist/css/chartist.min.css') }}">
@endsection

@section('breadcrumb')
<div class="col-sm-6 text-left" >
     <h4 class="page-title">Duty Station</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">Welcome to Fleet Time Management Tracker</li>
     </ol>
</div>
@endsection

@section('content')
<!-- Edit -->
           
            <h4 class="modal-title"><b><span class="employee_id">Edit Duty Station</span></b></h4>
            <div class="modal-body text-left">
                <form class="form-horizontal" method="POST" action="{{ route('stations.edit', $station->id) }}">
                    @csrf
                    @method('PUT')
                    {{-- <input type="hidden" name="_method" value="PATCH"> --}}
                    <div class="form-group">                                        

                        <div id="div_id_name" class="form-group required"> 
                            <label for="id_name" class="control-label col-md-4  requiredField"> Duty Station<span class="asteriskField">*</span> </label> 
                            <div class="controls col-md-8 "> 
                                <input type="text" class="input-md textinput textInput form-control" id="station" name="station" value="{{ $station->station }}"
                                required>
                            </div>
                        </div>
      
                    </div>

                    <div id="div_id_name" class="form-group required"> 
                        <label for="schedule" class="col-sm-12 control-label">Station Incharge</label>


                        <select class="form-control col-sm-8 " id="incharge_id" name="incharge_id" required>
                            @foreach($employees as $employee)
                            @if($employee->id===$station->incharge_id)
                            <option value="" selected>{{$employee->name}}</option>
                            @endif
                            <option value="{{$employee->id}}">{{$employee->name}} __ {{$employee->position}}  </option>
                            @endforeach

                        </select> 

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
