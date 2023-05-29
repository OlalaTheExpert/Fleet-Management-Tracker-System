
@extends('layouts.payment-head')

@section('css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>

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

@section('content')
@include('includes.flash')
@include('sweetalert::alert')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




                      <div class="row">
                            <div class="col-12">
                                <div class="card">
                                      
                                       
                                        <div class="row input-daterange">
                                            <div class="col-md-4">
                                                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" name="filter" id="filter" class="btn btn-success"><i class="fa fa-filter"></i> Filter</button>
                                                <button type="button" name="refresh" id="refresh" class="btn btn-info"> Refresh</button>
                                            </div>
                                        </div>
                                    <br>
                                    <br>
                                       
                                      
                                            <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="order_table">
                                                <thead>
                                                    <tr>
                                                        <th data-priority="1">S/NO</th>
                                                        
                                                        <th data-priority="1">CTG Number</th>
                                                        <th data-priority="2">Name</th>
                                                        <th data-priority="4" style="font-weight:bold;">Total Salary</th> 
                                                        <th data-priority="4">DSA T.Amount</th>                                                      
                                                        <th data-priority="6">Daily Rate</th>
                                                        <th data-priority="4">Days Worked</th>
                                                        <th data-priority="4">Inland</th>
                                                        <th data-priority="4">Overland</th>
                                                        <th data-priority="4">Sick Leave</th>
                                                        <th data-priority="4">Annual Leave</th>
                                                        <th data-priority="4">TT OT 1.5</th>
                                                        <th data-priority="4">TT OT 1.75</th>
                                                        <th data-priority="4">TT OT 2</th>
                                                        <th data-priority="4">TT OT 2.5</th>
                                                        <th data-priority="4">DSA Inland</th>
                                                        <th data-priority="4">DSA Overland</th>
                                                                                                             
                                                        
                                                     
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function(){
                                            $('.input-daterange').datepicker({
                                                todayBtn:'linked',
                                                format:'yyyy-mm-dd',
                                                autoclose:true
                                            });
                                    
                                            load_data();
                                    
                                            function load_data(from_date = '', to_date = ''){
                                                $('#order_table').DataTable({
                                                    processing: true,
                                                    serverSide: true,
                                                    ajax: {
                                                        url:'{{ route("daterange.index") }}',
                                                        data:{from_date:from_date, to_date:to_date}
                                                    },
                                                    columns: [
                                                        {"data":"id"},
                                                        // {"defaultContent":"<a href='#' class='btn btn-success btn-sm edit btn-flat'><i class='fa fa-edit'></i> Update</a> "},
                                                                         
                                                        {"data":"employee_name"},                    
                                                        {"data":"ctgnumber"},
                                                        {"data":"ttsalary"},
                                                        {"data":"dsaamount"},
                                                        {"data":"bsalary"},  
                                                        {"data":"daysworked"}, 
                                                        {"data":"inland"}, 
                                                        {"data":"overland"},
                                                        {"data":"sickleave"}, 
                                                        {"data":"annualleave"},
                                                        {"data":"ot15"},  
                                                        {"data":"ot175"},
                                                        {"data":"ot2"},
                                                        {"data":"ot25"},  
                                                        {"data":"dsainland"}, 
                                                        {"data":"dsaoverland"},
                                                        
                                                    ],
                                                });
                                                       
                                            }
                                    
                                            $('#filter').click(function(){
                                                var from_date = $('#from_date').val();
                                                var to_date = $('#to_date').val();
                                    
                                                if(from_date != '' &&  to_date != ''){
                                                    $('#order_table').DataTable().destroy();
                                                    load_data(from_date, to_date);
                                                } else{
                                                    alert('Both Date is required');
                                                }
                                    
                                            });
                                    
                                            $('#refresh').click(function(){
                                                $('#from_date').val('');
                                                $('#to_date').val('');
                                                $('#order_table').DataTable().destroy();
                                                load_data();
                                            });
                                        });
                                    </script>
                                    
                             
                        </div> <!-- end row -->    
              
                 
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
{{-- @foreach( $employees as $employee) 
 @include('includes.edit_delete_employee')
@endforeach --}}

{{-- @include('includes.add_employee') --}}

 @endsection


{{--@section('script')
<!-- Responsive-table-->

@endsection --}}