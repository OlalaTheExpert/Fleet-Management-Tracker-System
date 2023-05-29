@extends('layouts.master')

@section('css')
@endsection

@section('breadcrumb')
<div class="col-sm-6">

    @if(Session::has('message'))
    <div class="alert alert-danger">
      {{Session::get('message')}}
    </div>
  @elseif(session('Success'))
    <div class="alert alert-success">
      {{Session::get('Success')}}
    </div>
    @endif
    <h4 class="page-title text-left">Drivers</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Drivers</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Drivers List</a></li>
  
    </ol>
</div>
@endsection
{{-- @section('button')
<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i>Add</a>
        

@endsection --}}

@section('content')
@include('includes.flash')
@include('sweetalert::alert')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


                      <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                                    <thead>
                                                    <tr>
                                                        <th data-priority="1">S/NO</th>
                                                        <th data-priority="2">Name</th>
                                                        {{-- <th data-priority="3">Mission</th> --}}
                                                        <th data-priority="5">Duty Station</th>
                                                        <th data-priority="5">Unit</th>
                                                        <th data-priority="5">Monthly Rate</th>
                                                        {{-- <th data-priority="4">Vehicle Type</th>
                                                        <th data-priority="5">Vehicle Number</th>
                                                        <th data-priority="5">Vehicle Color</th>                                                       --}}
                                                        
                                                        <th data-priority="7">Payment</th>
                                                        {{-- <th data-priority="8">Delete</th> --}}
                                                     
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        
                                                        @foreach( $employees as $key=>$employee)
                                                        @isset($employee->station->station)
                                                        {{-- @if($employee->position==="Driver" && $employee->vehicle_id!== '0') --}}

                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{$employee->name}}</td>
                                                            {{-- <td>{{$employee->mission ?? 'NA'}}</td> --}}
                                                            <td>{{$employee->station->station ?? 'NA' }}</td>
                                                            <td>{{$employee->unit}}</td>
                                                            <td>{{$employee->monthly_rates}}</td>
                                                            {{-- <td>{{$employee->vehicle->type ?? 'NA' }}</td>
                                                          
                                                            <td>{{$employee->vehicle->plateno ?? 'NA'}}</td>
                                                            <td>{{$employee->vehicle->color ?? 'NA' }}</td> --}}
                                                            
                                                            <td>
                                                                @php
                                                                    $data= DB::table('employees')
                                                                        ->join('checks', 'emp_id', "=", 'employees.id')
                                                                        ->where('employees.id', $employee->id)
                                                                        ->get();
                                                                @endphp
                                                                @if ($data->count() == 0)
                                                                <span class="badge badge-pill badge-warning">No Attendance Record yet</span>
                                                                @else
                                                                
                                                                @if($employee->stat=== '1')
                                                               
                                                                <span class="badge badge-pill badge-success">Check records in the payroll</span>
                                                                @else
                                                                <a href="{{route('payment.updates', $employee->id)}}" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i> Update</a>
                                                                @endif

                                                                @endif
                                                                     
                                                            </td>
                                                            {{-- <td>
                                                              
                                                                 <a href="{{route('employees.destroy', $employee->id)}}" onclick="confirmation(event)" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat"><i class='fa fa-trash'></i> Delete</a> 
                                                               
                                                            </td> --}}
                                                        </tr>
                                                        @endisset
                                                        {{-- @endif --}}
                                                        
                                                        @endforeach
                                                   
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->    


                        <!-- Add -->

</div>
  
    <script>
        function confirmation(ev){
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);

            Swal.fire({
                title: 'Delete?',
                text: "Are you sure you want to remove this employee?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willCancel) => {
                if (willCancel.isConfirmed) {

                    window.location.href=urlToRedirect;
                // Swal.fire(
                //     Livewire.emit('deleteConfirmed')
                // )
                }
                else  {
                    Swal.fire(
                    'Cancelled',
                    'Remove request has been cancelled!',
                    'error'
                    )
                }
                
        })
        }
         
      
    
        </script>
@foreach( $employees as $employee) 
 @include('includes.edit_delete_employee')
@endforeach

{{-- @include('includes.add_payment_details') --}}

@endsection


@section('script')
<!-- Responsive-table-->

@endsection