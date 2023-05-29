@extends('layouts.employee')
@section('content')
@include('sweetalert::alert')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- /Sidebar -->
        
        <!-- Page Wrapper -->
        <div class="page-wrapper">
        
            <!-- Page Content -->
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="welcome-box">
                            <div class="welcome-img">
                                <img alt="" src="assets/img/profiles/avatar-02.jpg">
                            </div>
                            <div class="welcome-det">

                                <h3>Welcome, {{ auth()->user()->name }}  </h3>
                                <p>{{ now() }}</p>
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
                            <div class="alert alert-danger fs-4">
                                Sorry, No Payroll Updated! Please Wait
                              </div>
                            @else
                            @foreach( $user as $key => $user)
                            
                            <section>
                                <h5 class="dash-title">Summary </h5>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="time-list">
                                            <div class="dash-stats-list">
                                                <h4>{{ $user->ctgnumber ?? "Not Updated"}}</h4>
                                                <p>CTG Number</p>
                                            </div>
                                            <div class="dash-stats-list">
                                                <h4>{{ $user->position ?? "Not Updated" }}</h4>
                                                <p>Role</p>
                                            </div>
                                            <div class="dash-stats-list">
                                                <h4>{{ $user->unit ?? "Not Updated"}}</h4>
                                                <p>Unit</p>
                                            </div>
                                            <div class="dash-stats-list">
                                                
                                                
                                                <h4>{{  $user->station_name ?? "Not Updated" }}</h4>
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