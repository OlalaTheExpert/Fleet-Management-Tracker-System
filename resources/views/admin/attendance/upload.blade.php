
@extends('layouts.master')


@section('css')
    <!-- Table css -->
    <link href="{{ URL::asset('plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet"
        type="text/css" media="screen">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

@endsection


{{-- @include('includes.flash') --}}
{{-- @include('sweetalert::alert')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}


@section('breadcrumb')
    <div class="col-sm-6">
        <h4 class="page-title text-left">File Uploads </h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Uploads</a></li>
           
 

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

@if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
            </div>
        @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="page-title text-left">Showing attendance files Uploaded</h4>                    
                </div>
            </div>
            
                    <div class="table-rep-plugin">
                      
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                <thead>
                                    <tr>
                                        {{-- <th data-priority="1">ID</th> --}}
                                        <th data-priority="2">Uploaded By </th>
                                        <th data-priority="4">Station</th>
                                        <th data-priority="4">Approved By</th>
                                        <th data-priority="3">Date</th>
                                        <th data-priority="4">View</th> 
                                        <th data-priority="4">Status</th>
                                        
                                        @if(Auth::user()->role=='1')
                                        <th data-priority="5">Action</th>
                                       
                                        @endif
                                     

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($uploads as  $schedule)
                                    @if (Auth::user()->role=='1')
                                        <tr>
                                            {{-- <td> {{ $schedule->id }} </td> --}}
                                            @php
                                            $id=$schedule->station_id;
                                            $data= DB::table('stations')                                                
                                                ->where('id', $id)
                                                ->get();
                                            @endphp
                                            <td> {{ $schedule->uploaded_by }} </td>
                                            @if($id=='0')
                                            <td> From Admin </td>
                                            @else
                                            @foreach ($data as $name)
                                            
                                            <td> {{ $name->station }} </td>
                                            
                                            @endforeach   
                                            @endif    
                                            <td> {{ $schedule->approved_by ?? "Not approved" }} </td>                                     
                                            <td> {{ $schedule->updated_at }}  </td>
                                            
                                            <td>
                                                {{-- @php

                                                $file_uploaded=$schedule->file_name;
                                                    
                                                    $path = $request->$file_uploaded->store(
                                                        'uploads', 'public'
                                                    );
                                                @endphp          --}}

                                               
                                                
                                                <a href="{{ route('student.download', $schedule->id) }}"  target="_blank" class="fw-bold text-dark">
                                                <i class='bx bxs-file bx-sm'></i>
                                            </a>   
                                            </td>

                                            @if ($schedule->status=='0' && $schedule->Comment==0)
                                            <td><p class="badge badge-pill badge-warning"> Pending </p></td>
                                            @elseif ($schedule->status=='1' && $schedule->Comment==0)
                                            <td><p class="badge badge-pill badge-success"> Approved</p> </td> 
                                            @else
                                            <td><p class="badge badge-pill badge-danger"> Rejected </p><br><small>{{ $schedule->Comment }} </small> </td>
                                            @endif
                                                                               
                                            
                                             @if(Auth::user()->role=='1')
                                            <td>
                                                @if ($schedule->status=='0')

                                                <a href="#delete{{ $schedule->id }}" data-toggle="modal"
                                                    class="btn btn-success btn-sm delete btn-flat"><i
                                                        class='fa fa-check'></i> Approve</a>                                                
                                                <a href="#edit{{ $schedule->id }}" data-toggle="modal"
                                                    class="btn btn-danger btn-sm edit btn-flat"><i class="fa-thin fa-circle-xmark"></i>
                                                    Reject</a>
                                                @else
                                                <p class="badge badge-success"> Approved</p>
                                                @endif

                                            </td>
                                            @endif
                                        </tr>
                                        @elseif(Auth::user()->station_id==$schedule->station_id && Auth::user()->role=='Data-Clerk')
                                        <tr>
                                            {{-- <td> {{ $schedule->id }} </td> --}}
                                            @php
                                            $id=$schedule->station_id;
                                            $data= DB::table('stations')                                                
                                                ->where('id', $id)
                                                ->get();
                                            @endphp
                                            <td> {{ $schedule->uploaded_by }} </td>
                                            @if($id=='0')
                                            <td> From Admin </td>
                                            @else
                                            @foreach ($data as $name)
                                            
                                            <td> {{ $name->station }} </td>
                                            
                                            @endforeach   
                                            @endif     
                                            
                                            <td> {{ $schedule->approved_by ?? "Not Approved" }} </td>
                                            <td> {{ $schedule->updated_at }} </td>
                                            <td>
                                                {{-- @php

                                                $file_uploaded=$schedule->file_name;
                                                    
                                                    $path = $request->$file_uploaded->store(
                                                        'uploads', 'public'
                                                    );
                                                @endphp          --}}

                                               
                                                
                                                <a href="{{ route('student.download', $schedule->id) }}"  target="_blank" class="fw-bold text-dark">
                                                <i class='bx bxs-file bx-sm'></i>
                                            </a>   
                                            </td>

                                            @if ($schedule->status=='0' && $schedule->Comment==0)
                                            <td><p class="badge badge-pill badge-warning"> Pending </p></td>
                                            @elseif ($schedule->status=='1' && $schedule->Comment==0)
                                            <td><p class="badge badge-pill badge-success"> Approved</p> </td> 
                                            @else
                                            <td><p class="badge badge-pill badge-danger"> Rejected </p><br><small>{{ $schedule->Comment }} </small> </td>
                                            @endif
                                                                               
                                            
                                             @if(Auth::user()->role=='1')
                                           
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
    

    @foreach ($uploads as $schedule)
        @include('includes.upload_comments')
    @endforeach

    @include('includes.add_file')

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
