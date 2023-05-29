@extends('layouts.employee')
@section('content')

        <!-- /Sidebar -->
        
       <!-- Page Wrapper -->
       <div class="page-wrapper">
			
        <!-- Page Content -->
        <div class="content container-fluid">
        
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome {{ auth()->user()->name }}!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
        
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-truck"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $vehicleCount }}</h3>
                                <span>Vehicles</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-home"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $stationCount }}</h3>
                                <span>Stations</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-diamond"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $positionCount }}</h3>
                                <span>Roles</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-user"></i></span>
                            <div class="dash-widget-info">
                                <h3>{{ $emplCount }}</h3>
                                <span>Employees</span>
                            </div>
                        </div>
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
            <div class="row">
              
                <div class="col-lg-12 col-md-12">
                    <div class="dash-sidebar">
                        {{-- {{  $user }} --}}
                        {{-- {{ $employee }} --}}
                        @if($user->isEmpty())
                            <div class="alert alert-danger">
                                Sorry, Not Payroll Updated! 
                              </div>
                            @else
                        @foreach( $user as $key => $user)
                        
                        <section>
                            <h5 class="dash-title">Summary </h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="time-list">
                                        <div class="dash-stats-list">
                                            <h4>{{ $user->ctgnumber }}</h4>
                                            <p>CTG Number</p>
                                        </div>
                                        <div class="dash-stats-list">
                                            <h4>{{ $user->position }}</h4>
                                            <p>Role</p>
                                        </div>
                                        <div class="dash-stats-list">
                                            <h4>{{ $user->unit }}</h4>
                                            <p>Unit</p>
                                        </div>
                                        <div class="dash-stats-list">
                                            
                                            
                                            <h4>{{  $user->station_name }}</h4>
                                            <p>Station</p>
                                            
                                            
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                        </section>
                        <section>
                            <h5 class="dash-title">Salary</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="time-list">
                                        <div class="dash-stats-list">
                                            <h4>{{ $user->bsalary }}</h4>
                                            <p>Daily Rates</p>
                                        </div>
                                        <div class="dash-stats-list">
                                            <h4>{{ $user->daysworked }}</h4>
                                            <p>Days Worked</p>
                                        </div>
                                        <div class="dash-stats-list">
                                            <h4>{{ $user->inland }}</h4>
                                            <p>Inland</p>
                                        </div>
                                        <div class="dash-stats-list">
                                            <h4>{{ $user->overland }}</h4>
                                            <p>Overland</p>
                                        </div>
                                    </div>
                                    {{-- <div class="request-btn">
                                        <a class="btn btn-primary" href="#">Apply Leave</a>
                                    </div> --}}
                                </div>
                            </div>
                        </section>
                        <section>
                            <h5 class="dash-title">Total Salary</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="time-list">
                                        <div class="dash-stats-list">
                                            <h4>$ {{ $user->dsaamount }}</h4>
                                            <p>DSA Amount</p>
                                        </div>
                                        <div class="dash-stats-list">
                                            <h4>$ {{ $user->ttsalary }}</h4>
                                            <p>Net Salary</p>
                                        </div>
                                    </div>
                                    {{-- <div class="request-btn">
                                        <a class="btn btn-primary" href="#">Apply Time Off</a>
                                    </div> --}}
                                </div>
                            </div>
                        </section>
                      
                        @endforeach
                        @endif
                        {{-- <section>
                            <h5 class="dash-title">Upcoming Holiday</h5>
                            <div class="card">
                                <div class="card-body text-center">
                                    <h4 class="holiday-title mb-0">Mon 20 May 2019 - Ramzan</h4>
                                </div>
                            </div>
                        </section> --}}
                    </div>
                </div>
            </div>
         
            
          
            
          
            
          
        
        </div>
        <!-- /Page Content -->

    </div>
    <!-- /Page Wrapper -->
        
   
        @endsection