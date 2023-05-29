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
    <h4 class="page-title text-left">Job Positions</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Management</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Job Positions</a></li>
  
    </ol>
</div>
@endsection
@section('button')
<a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="mdi mdi-plus mr-2"></i>Add</a>
        

@endsection

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
                                        <th data-priority="3">Job Position</th>
                                        <th data-priority="3">Monthly Rates</th>
                                        <th data-priority="4">Date Created</th>
                                        <th data-priority="5">Date Updated</th>
                                        <th data-priority="6">Edit</th>
                                        <th data-priority="7">Delete</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $positions as $position)

                                        <tr>
                                            <td>{{$position->id}}</td>
                                            <td>{{$position->position}}</td>
                                            <td>USD {{$position->monthly_rates ?? "0.00"}}</td>
                                                                                                        
                                            {{-- <td>
                                                
                                                @if(isset($employee->schedules->first()->slug))
                                                {{$employee->schedules->first()->slug}}
                                                @endif 
                                            </td> --}}
                                            <td>{{$position->created_at}}</td>
                                            <td>{{$position->updated_at}}</td>
                                            <td>                        
                                                <a href="{{route('positions.update', $position->id)}}" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i> Edit</a>
                                                
                                            </td>
                                            <td>
                                                <a href="{{route('positions.delete', $position->id)}}" onclick="confirmation(event)" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat"><i class='fa fa-trash'></i> Delete</a> 
                                            </td>
                                        </tr>
                                        @endforeach
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->    
              
                        
              
    <script>
        function confirmation(ev){
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);

            Swal.fire({
                title: 'Delete?',
                text: "Are you sure you want to remove this Job group?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willCancel) => {
                if (willCancel.isConfirmed) {

                    window.location.href=urlToRedirect;
                
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
{{-- @foreach( $employees as $employee) 
 @include('includes.edit_delete_employee')
@endforeach --}}

@include('includes.add_positions')

@endsection


@section('script')
<!-- Responsive-table-->

@endsection