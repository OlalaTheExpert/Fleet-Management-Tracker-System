

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
    <h4 class="page-title text-left">Employees {{  $end  }}</h4>
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


<a href="{{route('paymentall')}}" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i> Update</a>
                                                               
                      <div class="row"> 
                            <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('payrollfilter') }}">
                        @csrf
                        
                    <div class="row"> 
                        
                        
                        <div class="col-md-4">
                            
                            {{-- <input type="month" name="from_date" class="form-control" placeholder="From Date" /> --}}
                       
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Select month & year</span>
                            <input type="month" class="form-control" name="to_date" id="to_date" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
                          </div>
                        </div>
                    
                        <div class="col-md-4">
                            <button type="submit"  name="filter"  class="btn btn-success"><i class="fa fa-filter"></i> Filter</button>
                       </form>
                                           
                        <a href="{{route('payments_list')}}" name="refresh" id="refresh" class="btn btn-info"> Refresh</a>
                    </div>
                   
                </div>
                <h4 class="page-title text-left">Payroll Batch {{ $filter_dates ?? today()->format('F, Y')}}</h4>
            </div>
            <script>
                $(document).ready(function(){
                    $('.input-daterange').datepicker({
                        todayBtn:'linked',
                        format:'mm',
                        autoclose:true
                    });
            
                });
            </script>
                
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">
                                                <table id="datatable-buttons" class="table table-striped table-bordered table-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        
                                                    <thead>
                                                    <tr>
                                                        <th data-priority="1">S/NO</th>
                                                        <th data-priority="1">Status</th>
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
                                                    <tbody>
                                                        @foreach( $payments as $key => $payment)

                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>  
                                                                <a href="{{route('payment.done', $payment->employee_id)}}" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i> Update</a>
                                                                {{-- @if($end <= now())
                                                                <a href="{{route('payment.done', $payment->employee_id)}}" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i> Update</a>
                                                                @else
                                                                <a href="{{route('payment.done', $payment->employee_id)}}" class="btn btn-success btn-sm edit btn-flat"><i class='fa fa-edit'></i> Update</a>
                                                               
                                                                <button type="button" class="btn btn-success btn-sm edit btn-flat">Updated</button>
                                                                
                                                                @endif --}}
                                                            </td>
                                                            <td>{{$payment->ctgnumber}}</td>
                                                            <td>{{$payment->employee_name}}</td>
                                                            {{-- <td>{{$payment->position}}</td>
                                                            <td>{{$payment->email}}</td> --}}
                                                            <td style=" font-weight:bold;">$ {{$payment->ttsalary}}</td>
                                                            <td style=" font-weight:bold;">$ {{$payment->dsaamount}}</td>
                                                            <td>{{$payment->bsalary}}</td>
                                                            <td>{{$payment->daysworked}}</td>
                                                            <td>{{$payment->inland}}</td>
                                                            <td>{{$payment->overland}}</td>
                                                            <td>{{$payment->sickleave}}</td>
                                                            <td>{{$payment->annualleave}}</td>
                                                            <td>{{$payment->ot15}}</td>
                                                            <td>{{$payment->ot175}}</td>
                                                            <td>{{$payment->ot2}}</td>
                                                            <td>{{$payment->ot25}}</td>
                                                            <td>{{$payment->dsainland}}</td>
                                                            <td>{{$payment->dsaoverland}}</td>                                                           
                                                                                                                       
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


@section('script')
<!-- Responsive-table-->

@endsection