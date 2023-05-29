@extends('layouts.master')

@section('css')
    <!-- Table css -->
    <link href="{{ URL::asset('plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet"
        type="text/css" media="screen">
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">Leave</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Leave</a></li>


        </ol>
    </div>
@endsection
{{-- @section('button')
    <a href="leave/assign" class="btn btn-primary btn-sm btn-flat"><i
            class="mdi mdi-plus mr-2"></i>Add New</a>


@endsection --}}

@section('button')
<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i>Add New</a>
        

@endsection

@section('content')
@include('includes.flash')
@if(Session::has('message'))
<div class="alert alert-danger">
  {{Session::get('message')}}
</div>
@elseif(session('Success'))
<div class="alert alert-success">
  {{Session::get('Success')}}
</div>
@endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                <thead>
                                    <tr>
                                        <th data-priority="1">S/NO</th>
                                        <th data-priority="1">Employee</th>
                                        {{-- <th data-priority="2">Employee ID</th>
                                        <th data-priority="3">Name</th> --}}
                                        <th data-priority="4">Type</th>
                                        <th data-priority="4">Leave days</th>
                                        <th data-priority="6">Leave Date</th>
                                        <th data-priority="7">Return Date</th>


                                    </tr>
                                </thead>
                                
                            <tbody>
                                @foreach( $leaves as $key => $leave)

                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    
                                    @php
                                            $id=$leave->employee_id;
                                            $data= DB::table('employees')                                                
                                                ->where('employees.id', $id)
                                                ->get();
                                            @endphp
                                            @foreach ($data as $name)
                                            <td> {{ $name->name }} </td>
                                            @endforeach
                                    {{-- <td>{{$leave->employee_id}}</td> --}}
                                    <td>{{$leave->type}}</td>
                                    <td>{{$leave->days}}
                                    <td>{{$leave->leave_date}}</td>
                                    {{-- <td>{{$leave->employee->name}}</td> --}}
                                    {{-- <td>{{$leave->employee->name}}</td> --}}
                                    <td>{{$leave->return_date}}
                                        {{-- @if( $leave->status == 1 )
                                        <span class="badge badge-primary badge-pill float-right">On Time</span>
                                        @else
                                        <span class="badge badge-danger badge-pill float-right">Early GO</span>
                                        @endif --}}
                                    </td>
                                    {{-- <td>{{$leave->employee->schedules->first()->time_in}} </td>
                                    <td>{{$leave->employee->schedules->first()->time_out}}</td> --}}
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('includes.add_leave')

@endsection
