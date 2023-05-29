@extends('layouts.master')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://momentjs.com/downloads/moment.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>


    <div class="card">
        <div class="col-md-6">
            {{-- <h4 class="page-title text-left">Tracking attendance for {{  today()->format('F')}}</h4> --}}
            {{-- <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly /> --}}
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('trackerfilter') }}">
                        @csrf
                    <div class="row input-daterange"> 
                        
                        
                        <div class="col-md-6">
                            <h4 class="page-title text-left">Showing attendance for {{ $show ?? today()->format('F')}}</h4>
                            {{-- <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly /> --}}
                        </div>
                        <div class="col-md-3">
                            <input type="hidden" name="employee_id" id="employee_id" value="{{ $employee->id }}" class="form-control" />
                            <input type="month" name="to_date" id="to_date" class="form-control" placeholder="Date" />
                        </div>
                        {{-- <div class="form-group">
                            <div class="input-group date" id="datetimepicker1">
                                <input type="text" class="form-control" />	<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                            </div>
                        </div> --}}
                    
                        <div class="col-md-3">
                            <button type="submit"  name="filter"  class="btn btn-success"><i class="fa fa-filter"></i> Filter</button>
                       
                    
                    </form>
                   
                        <a href="{{route('sheet-report', $employee->id)}}" name="refresh" id="refresh" class="btn btn-info"> Refresh</a>
                    </div>
                </div>
            </div>
        <div class="card-body">
            <table id="datatable-buttons" class="table table-striped table-bordered table-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                <thead>
                <tr>
                       
                   
                            <th>Employee Name </th>
                            <th>Employee Position</th>
                            <th>Duty Station</th>
                            
                            
                            @php

                                $tday= \Carbon\Carbon::parse($date)->format('Y-m-d H:i:s');
                                
                                $check=today();
                                $month = date("m",strtotime($date));
                                $year = date("Y",strtotime($date));
                                $number = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                
                                $dates = [];
                                
                                for ($i = 1; $i < $number + 1; ++$i) {
                                    $dates[] = \Carbon\Carbon::createFromDate($year, $month, $i)->format('Y-m-d');
                                }
                                
                            @endphp
                            @foreach ($dates as $date)
                            <th style="">
                            
                                
                                    {{ $date }}
                            
                        </th>
                      

                            @endforeach

                        </tr>
                    </thead>

                    <tbody>

                        {{-- @foreach ($employees as $employee) --}}

                            <input type="hidden" name="emp_id" value="{{ $employee->id }}">

                            <tr>

                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>{{ $employee->station_name }}</td>
                                
                                 @for ($i = 1; $i < $number + 1; ++$i)

                                    @php
                                        
                                        $date_picker = \Carbon\Carbon::createFromDate($year, $month, $i)->format('Y-m-d');
                                        
                                        $check_attd = \App\Models\Schedule::query()
                                            ->where('employee_id', $employee->id)
                                            ->where('created_at', $date_picker)
                                            ->first();
                                        
                                        $check_leave = \App\Models\Leave::query()
                                            ->where('employee_id', $employee->id)
                                            ->where('leave_date', $date_picker)
                                            ->first();
                                        
                                    @endphp
                                    <td>

                                        <div class="form-check form-check-inline ">

                                            @if (isset($check_attd))
                                                 @if ($check_attd->status==1)
                                                 <i class="fa fa-check text-success"></i>
                                                 @else
                                                 <i class="fa fa-check text-success"></i>
                                                 @endif                                               
                                            @else
                                            <i class="fas fa-times text-danger"></i> 
                                            @endif
                                        </div>
                                        {{-- <div class="form-check form-check-inline">
                                          
                                            @if (isset($check_leave))
                                            @if ($check_leave->status==1)
                                            <i class="fa fa-check text-success"></i>
                                            @else
                                            <i class="fa fa-check text-danger"></i>
                                            @endif
                                          
                                       @else
                                       <i class="fas fa-times text-danger"></i>
                                       @endif --}}
                                        

                                        </div>

                                    </td>

                                @endfor
                            </tr>
                        {{-- @endforeach --}}





                    </tbody>


                </table>
            </div>
        </div>
    </div>
    
    <script>
        // $('#datetimepicker1').datetimepicker();

        $("#datetimepicker1").datetimepicker( {
        // format: "mm-yyyy",
        // viewMode: "months", 
        // minViewMode: "months"
    });
        </script>
@endsection
