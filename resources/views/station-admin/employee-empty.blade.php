@extends('layouts.employee')
@section('content')
@include('sweetalert::alert')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Page Wrapper -->
<div class="page-wrapper">
			
    <!-- Page Content -->
    <div class="content container-fluid">
    
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Station Employees </h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Employee</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
                    <div class="view-icons">
                        
                        <a href="{{ redirect()->back()  }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                        <a href="{{ route('stationemplist')  }}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
            </div>
         
                @if(Session::has('message'))
                <div class="alert alert-danger">
                  {{Session::get('message')}}
                </div>
              @elseif(session('Success'))
                <div class="alert alert-success">
                  {{Session::get('Success')}}
                </div>
                @endif
           
           
        </div>
        <!-- /Page Header -->
        
       
        
        
    
        <div class="row staff-grid-row">
            @foreach( $employees as $key => $employee)
           
            @if($employee->stat == '0' && $employee->permissions=='1' )
            <div class="col-md-12 col-sm-12 col-12 col-lg-12 col-xl-12">           
      
       
        <div class="alert alert-danger">
            Sorry, No employee available under your station at the moment
          </div>
            </div>
        
     
         
           
        </div>
       
          
    </div>
    <!-- /Page Content -->
    
    <!-- Add Employee Modal -->
    <div id="add_employee" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('employees.stationstore') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Full name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" id="name">
                                    <input class="form-control" type="hidden" name="station_name" id="station_name" value="{{ $employee->station_name }}">
                                    <input class="form-control" type="hidden" name="station_id" id="station_id" value="{{ $employee->station_id }}">
                                </div>
                            </div>                           
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                    <input class="form-control" type="email" name="email">
                                </div>
                            </div>
                          
                            <div class="col-sm-6">  
                                <div class="form-group">
                                    <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ctgnumber">
                                </div>
                            </div>
                           
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Phone </label>
                                    <input class="form-control" type="text" name="phone_number">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Daily Rate </label>
                                    <input class="form-control" type="text" name="bsalary">
                                </div>
                            </div>
                        
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Designation <span class="text-danger">*</span></label>
                                    <select class="select" name="position">
                                        @foreach($positions as $position)
                                    <option value="{{$position->position}}">{{$position->position}}  </option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Unit <span class="text-danger" >*</span></label>
                                <select class="select" name="unit">
                                    <option>Support</option>
                                    <option>Fleet</option>                                   
                                </select>
                            </div>
                        </div>
                        
                    </div>
                       
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Employee Modal -->
    
    <!-- Edit Employee Modal -->
    {{-- @foreach( $employees as $employee) --}}
    {{-- <div id="edit_employee_{{ $employee->id }}" class="modal custom-modal fade" role="dialog" tabIndex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form method="POST" action="{{ route('employeestationedit', $employee->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                    <input class="form-control" value="{{ $employee->name }}" type="text">
                                </div>
                            </div>                           
                           
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                    <input class="form-control" value="{{ $employee->email }}" type="email">
                                </div>
                            </div>
                            <div class="col-sm-6">  
                                <div class="form-group">
                                    <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $employee->ctgnumber }}" name="ctgnumber">
                                </div>
                            </div>                           
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-form-label">Phone </label>
                                    <input class="form-control" type="number" value="{{ $employee->phone_number }}" name="phone_number">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Daily Rate </label>
                                    <input class="form-control" type="text" value="{{ $employee->bsalary }}" name="bsalary">
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
    </div> --}}
    {{-- @endforeach --}}
    
    <!-- /Edit Employee Modal -->
    
    <!-- Delete Employee Modal -->
    <div class="modal custom-modal fade" id="delete_employee" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Employee</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Employee Modal -->
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
</div>
<!-- /Page Wrapper -->
   <!-- Script -->

 </body>
 </html>
@endsection