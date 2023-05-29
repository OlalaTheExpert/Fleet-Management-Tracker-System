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
    <div class="float-right">
    
</div>
    <h4 class="page-title text-left">Users</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Users</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">All Users</a></li>
  
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
                                                        <th data-priority="1">Username</th>
                                                        <th data-priority="2">FullName</th>
                                                        
                                                        <th data-priority="4">Email</th>
                                                        <th data-priority="3">Role</th>                                                    
                                                        <th data-priority="7">Manage</th>
                                                        <th data-priority="8">Action</th>
                                                     
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php($count=0)
                                                        @foreach( $users as $user)
                                                        @if($user->permissions != '2')
                                                        @php($count++)

                                                        <tr>
                                                            <td>{{$count}}</td>
                                                            <td>{{$user->name}}</td>
                                                            <td>{{$user->fullname}}</td>
                                                            <td>{{$user->email}}</td>
                                                            @if($user->role === '0')
                                                            <td>Employee</td>
                                                            @elseif($user->role == '1')
                                                            <td>Admin</td>
                                                            @else
                                                            <td>{{ $user->role }}</td>
                                                            @endif
                                                            
                                                            <td>
                        
                                                                <a href="{{route('updatepassword', $user->id)}}" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-key'></i></a>
                                                                
                                                            </td>
                                                            <td>
                                                               
                                                                @if($user->permissions === '0')
                                                                 <a href="{{route('unblock', $user->id)}}" class="btn btn-success btn-sm delete btn-flat">unblock</a> 
                                                                 @else
                                                                 <a href="{{route('block', $user->id)}}" onclick="confirmation(event)" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat">Block</a> 
                                                                 
                                                                 @endif
                                                                 <a href="{{route('updatepassword', $user->id)}}" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i>Edit</a>
                                                                 
                                                                 {{-- <form method="POST" action="{{route('employees.destroy', $employee->id)}}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('DELETE')
                                        
                                                                    <button class="btn btn-danger">Delete</button>
                                        
                                                                  </form> --}}
                                                            </td>
                                                        </tr>
                                                       @endif
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
                title: 'Block?',
                text: "Are you sure you want to Block this User?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Block!'
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

@include('admin.users.add_new_user')

@endsection


@section('script')
<!-- Responsive-table-->

@endsection