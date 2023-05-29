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
    <h4 class="page-title text-left">Employees </h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Employees</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0);">Employees List</a></li>
  
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
                                                <table id="datatable-buttons" class="table table-striped table-bordered table-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                                    <thead>
                                                    <tr>
                                                        <th data-priority="1">S/NO</th>
                                                        <th data-priority="1">CTG Number</th>
                                                        <th data-priority="2">Name</th>
                                                        <th data-priority="3">Position</th>
                                                        <th data-priority="4">Email</th>                                                       
                                                        <th data-priority="6">Monthly Rate</th>
                                                        <th data-priority="4">Unit</th>
                                                        <th data-priority="6">Member Since</th>
                                                        <th data-priority="7" id="not-export-col" class="not-export-col">Edit</th>                                                       
                                                        <th data-priority="8" class="not-export-col">Delete</th> 
                                                     
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach( $employees as $key => $employee)
                                                        {{-- @if($employee->position !='Driver') --}}

                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{$employee->ctgnumber}}</td>
                                                            <td>{{$employee->name}}</td>
                                                            <td>{{$employee->position}}</td>
                                                            <td>{{$employee->email}}</td>
                                                            <td>$ {{$employee->monthly_rates ?? "0.00"}}</td>
                                                            <td>{{$employee->unit}}</td>
                                                            <td>{{$employee->created_at}}</td>
                                                            


                                    
                                                            <td id="edset">
                        
                                                                <a href="{{route('admin.edit', $employee->id)}}" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i> Edit</a>
                                                                
                                                            </td>
                                                            <td id="edset">
                                                                {{-- {{ Form::open(['route' => ['employees.destroy', $employee->id], 'method' => 'DELETE', 'id' => 'confirm_delete']) }}
                         --}}
                                                                {{-- <a href="#edit{{$employee->name}}" data-toggle="modal" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i> Edit</a> --}}
                                                                 <a href="{{route('employees.destroy', $employee->id)}}" onclick="confirmation(event)" data-toggle="modal" class="btn btn-danger btn-sm delete btn-flat"><i class='fa fa-trash'></i> Delete</a> 
                                                                {{-- <form method="POST" action="{{route('employees.destroy', $employee->id)}}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('DELETE')
                                        
                                                                    <button class="btn btn-danger">Delete</button>
                                        
                                                                  </form> --}}
                                                            </td>
                                                        </tr>
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
              
                        
                        {{-- <script type="text/javascript">
                            $(document).ready(function(){
                                $( "#confirm_delete" ).submit(function( event ) {
                                    event.preventDefault();
                                    Swal.fire({
                                        title: 'Delete?',
                                        text: "Are you sure you want to remove this employee?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Yes, delete it!'
                                    }).then(function() {
                                            $("#confirm_delete").off("submit").submit();
                                    }, function(dismiss) {
                                        // dismiss can be 'cancel', 'overlay',
                                        // 'close', and 'timer'
                                        if (dismiss === 'cancel') {
                                            swal('Cancelled', 'Delete Cancelled :)', 'error');
                                        }
                                    })
                                });
                            });
                        </script> --}}
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

@include('includes.add_employee')

@endsection


@section('script')
<!-- Responsive-table-->
<script>

    // $(document).ready(function() {
    //   var ignorePositions = []; // column indexes of data NOT to be exported
    //   var reversedHeaders = []; // with "not-export" headings removed
    
    //   var table = $('#datatable-buttons').DataTable( {
    //     dom: 'B<"top"iflp<"clear">>rt<"bottom"ip<"clear">>',
    //     initComplete:function (  ) {
    //       var thead = $( '#datatable-buttons' ).DataTable().table().header();
    //       var tds = $( thead ).find( 'th' ).each(function( index ) {
    //         if ( ! $( this ).hasClass('not-export-col') ) {
    //           reversedHeaders.push( $( this ).text() );
    //         } else {
    //           ignorePositions.push(index);
    //         }
    //       });
    //       reversedHeaders.reverse(); // to give us the export order we want
    //       ignorePositions.reverse(); // reversed for when we splice() - see below
    //     },
    //     buttons: [
    //       { 
    //         extend: 'pdf',
    //         text: 'PDF',
    //         exportOptions: {
    //           rows: function ( idx, data, node ) {
    //             var keepRowData = [];
    //             // we splice to remove those data fields we do not want to export:
    //             ignorePositions.forEach(idx => data.splice(idx, 1) );
    //             return data.reverse();
    //           },
    //           columns: ':visible:not(.not-export-col)',
    //           format: { 
    //             header: function ( data, idx, node ) {
    //               return reversedHeaders[idx];
    //             }
    //           }
    //         }
    //       }
    //     ]
    //   } );
    // } );
    
    </script>
@endsection