
@extends('layouts.master')


@section('css')
    <!-- Table css -->
    <link href="{{ URL::asset('plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet"
        type="text/css" media="screen">
@endsection


{{-- @include('includes.flash') --}}
{{-- @include('sweetalert::alert')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}


@section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">Schedules </h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Schedule</a></li>
 

        </ol>
    </div>
    
   
@endsection
@section('button')
    <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i>Add</a>


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
                    <form method="POST" action="{{ route('filter') }}">
                        @csrf
                    <div class="row input-daterange"> 
                        
                        
                        <div class="col-md-6">
                            <h4 class="page-title text-left">Showing attendance for {{ $filter_dates ?? today()->format('d-m-Y')}}</h4>
                            {{-- <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly /> --}}
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="to_date" id="to_date" class="form-control" placeholder="Date" />
                        </div>
                    
                        <div class="col-md-3">
                            <button type="submit"  name="filter"  class="btn btn-success"><i class="fa fa-filter"></i> Filter</button>
                       
                    
                    </form>
                                           
                        <a href="/schedule" name="refresh" id="refresh" class="btn btn-info"> Refresh</a>
                    </div>
                </div>
            </div>
            
                    <div class="table-rep-plugin">
                      
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                <thead>
                                    <tr>
                                        {{-- <th data-priority="1">ID</th> --}}
                                        <th data-priority="2">Employee </th>
                                        <th data-priority="2">Station </th>
                                        <th data-priority="3">Time In</th>
                                        <th data-priority="4">Time Out</th>
                                        <th data-priority="4">Days In</th>
                                        @if(Auth::user()->role=='1')
                                        <th data-priority="5">Action</th>
                                       
                                        @endif
                                     

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules as  $schedule)
                                    @if (Auth::user()->role=='1')
                                        <tr>
                                            {{-- <td> {{ $schedule->id }} </td> --}}
                                            @php
                                            $id=$schedule->employee_id;
                                            $data= DB::table('employees')                                                
                                                ->where('employees.id', $id)
                                                ->get();
                                            @endphp
                                            @foreach ($data as $name)
                                            <td><a href="{{route('sheet-report', $id)}}">{{ $name->name }}</a> </td>
                                            <td> {{ $name->station_name }} </td>
                                            @endforeach
                                            <td> {{ $schedule->time_in }} </td>
                                            <td> {{ $schedule->time_out }} </td>
                                            @php
                                            $id=$schedule->employee_id;
                                            $checks= DB::table('checks')                                                
                                                ->where('checks.emp_id', $id)
                                                ->get();
                                            @endphp
                                            @foreach ($checks as $checkdays)
                                            <td> {{ $checkdays->attendance_time }} </td>
                                            @endforeach 
                                            @if(Auth::user()->role=='1')
                                            <td>

                                                <a href="#edit{{ $schedule->id }}" data-toggle="modal"
                                                    class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i>
                                                    Edit</a>
                                                <a href="#delete{{ $schedule->id }}" data-toggle="modal"
                                                    class="btn btn-danger btn-sm delete btn-flat"><i
                                                        class='fa fa-trash'></i> Delete</a>

                                            </td>
                                            @endif
                                        </tr>
                                        @elseif(Auth::user()->station_id==$schedule->station_id && Auth::user()->role=='Data-Clerk')
                                        <tr>
                                           
                                            @php
                                            $id=$schedule->employee_id;
                                            $data= DB::table('employees')                                                
                                                ->where('employees.id', $id)
                                                ->get();
                                            @endphp
                                            @foreach ($data as $name)
                                            <td> {{ $name->name }} </td>
                                            <td> {{ $name->station_name }} </td>
                                            @endforeach
                                            <td> {{ $schedule->time_in }} </td>
                                            <td> {{ $schedule->time_out }} </td>
                                            @php
                                            $id=$schedule->employee_id;
                                            $checks= DB::table('checks')                                                
                                                ->where('checks.emp_id', $id)
                                                ->get();
                                            @endphp
                                            @foreach ($checks as $checkdays)
                                            <td> {{ $checkdays->attendance_time }} </td>
                                            @endforeach 
                                            @if(Auth::user()->role=='1')
                                            <td>

                                                <a href="#edit{{ $schedule->id }}" data-toggle="modal"
                                                    class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i>
                                                    Edit</a>
                                                <a href="#delete{{ $schedule->id }}" data-toggle="modal"
                                                    class="btn btn-danger btn-sm delete btn-flat"><i
                                                        class='fa fa-trash'></i> Delete</a>

                                            </td>
                                            @endif
                                        </tr>
                                        @endif
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                   
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <script>
        $(document).ready(function(){
            $('.input-daterange').datepicker({
                todayBtn:'linked',
                format:'yyyy-mm-dd',
                autoclose:true
            });
    
           // load_data();
    
            // function load_data(from_date = '', to_date = ''){
            //     $('#order_table').DataTable({
            //         processing: true,
            //         serverSide: true,
            //         ajax: {
            //             url:'{{ route("daterange.index") }}',
            //             data:{from_date:from_date, to_date:to_date}
            //         },
            //         columns: [
            //             {"data":"id"},
            //             // {"defaultContent":"<a href='#' class='btn btn-success btn-sm edit btn-flat'><i class='fa fa-edit'></i> Update</a> "},
                                         
            //             {"data":"employee_name"},                    
            //             {"data":"ctgnumber"},
            //             {"data":"ttsalary"},                      
            //             {"defaultContent":"<a href='#edit'**+id+**'' data-toggle='modal' class='fa fa-edit color-green'></a>"},
            //             {"defaultContent":"<a href='#delete' data-toggle='modal' class='fa fa-trash color-red'></i> </a>"},
            //             //<a href='#' class='btn btn-success btn-sm edit btn-flat'><i class='fa fa-edit'></i> Update</a> 
                        
                        
            //         ],
            //     });
                       
            // }
    
            // $('#filter').click(function(){
            //     var from_date = $('#from_date').val();
            //     var to_date = $('#to_date').val();
    
            //     if(from_date != '' &&  to_date != ''){
            //         $('#order_table').DataTable().destroy();
            //         load_data(from_date, to_date);
            //     } else{
            //         alert('Both Date is required');
            //     }
    
            // });
    
            // $('#refresh').click(function(){
            //     $('#from_date').val('');
            //     $('#to_date').val('');
            //     $('#order_table').DataTable().destroy();
            //     //load_data();
            // });
        });
    </script>
    

    @foreach ($schedules as $schedule)
        @include('includes.edit_delete_schedule')
    @endforeach

    @include('includes.add_schedule')

@endsection


@section('script')
    <!-- Responsive-table-->
    <script src="{{ URL::asset('plugins/RWD-Table-Patterns/dist/js/rwd-table.min.js') }}"></script>
@endsection

@section('script')
    <script>
        $(function() {
            $('.table-responsive').responsiveTable({
                addDisplayAllBtn: 'btn btn-secondary'
            });
        });
    </script>
@endsection
