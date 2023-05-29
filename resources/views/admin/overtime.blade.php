@extends('layouts.master')

@section('css')
    <!-- Table css -->
    <link href="{{ URL::asset('plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet"
        type="text/css" media="screen">
@endsection

@section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">Over Time</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Over Time</a></li>


        </ol>
    </div>
@endsection
@section('button')
<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i>Add Overtime</a>
  
    <a href="/leave" class="btn btn-primary btn-sm btn-flat"><i class="mdi mdi-table mr-2"></i>Leave Table</a>

 

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
                                       
                                        
                                        <th data-priority="1">Employee Name</th>                                        
                                        <th data-priority="3">Station</th>
                                        <th data-priority="4">Overtime Date</th>
                                        <th data-priority="5">OverTime (Hours)</th>
                                        <th data-priority="6">Time In</th>
                                        <th data-priority="7">Time Out</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($overtimes as $overtime)

                                        <tr>
                                            
                                            
                                            @php
                                            $id=$overtime->emp_id;
                                            $data= DB::table('employees')                                                
                                                ->where('employees.id', $id)
                                                ->get();
                                            @endphp
                                            @foreach ($data as $name)
                                            <td> {{ $name->name }} </td>
                                            <td> {{ $name->station_name }} </td>
                                            @endforeach
                                            <td>{{ $overtime->overtime_date }}</td>
                                            {{-- <td>{{ $overtime->employee->name }}</td> --}}
                                            <td>{{ $overtime->duration }} </td>
                                            <td>{{ $overtime->time_in }} </td>
                                            <td>{{ $overtime->time_out }}</td>
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

        {{-- @foreach ($employees as $schedule)
        @include('includes.edit_delete_schedule')
    @endforeach --}}

    @include('includes.add_overtime')

@endsection
        
