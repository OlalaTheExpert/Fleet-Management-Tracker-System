
@extends('layouts.employee')
@section('content')
	<!-- Page Wrapper -->
    <div class="page-wrapper">
			
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Edit {{ $employee->name }} Details</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                  
                    <form method="POST" action="{{ route('employeestationupdate', $employee->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                    <input class="form-control" name="name" value="{{ $employee->name }}" type="text" required>
                                </div>
                            </div>                           
                           
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                    <input class="form-control" name="email" value="{{ $employee->email }}" type="email" required>
                                </div>
                            </div>
                            <div class="col-sm-6">  
                                <div class="form-group">
                                    <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $employee->ctgnumber }}" name="ctgnumber" required>
                                </div>
                            </div>                           
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Phone </label>
                                    <input class="form-control" type="number" value="{{ $employee->phone_number }}" name="phone_number" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Daily Rate </label>
                                    <input class="form-control" type="text" value="{{ $employee->bsalary }}" name="bsalary" required>
                                </div>
                            </div>                           
                           
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Designation <span class="text-danger">*</span></label>
                                    <select class="select" name="position">
                                        <option value="{{ $employee->position }}" selected>{{ $employee->position }}</option>
                                        @foreach($positions as $position)
                                    <option value="{{$position->position}}">{{$position->position}}  </option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Unit <span class="text-danger" >*</span></label>
                                <select class="select"  name="unit">
                                    <option>Support</option>
                                    <option>Fleet</option>                                   
                                </select>
                            </div>
                        </div>
                       
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
        <!-- /Page Content -->
        
    </div>
    <!-- /Page Wrapper -->

    @endsection