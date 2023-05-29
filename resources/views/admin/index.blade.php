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
    <h4 class="page-title">Dashboard</h4>
     <ol class="breadcrumb">
         <li class="breadcrumb-item active">Welcome to Fleet Time Management Tracker</li>
     </ol>
</div>
@endsection
@section('button')



@section('content')
@include('includes.flash')
@include('sweetalert::alert')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    /**
 * Document   : Auto Logout Script
 * Author     : josephtinsley
 * Description: Force a logout automatically after a certain amount of time using HTML/JQuery/PHP. 
 * http://twitter.com/josephtinsley 
 */


$(function() {

function timeChecker() {
    setInterval(function() {
        // var storedTimeStamp = sessionStorage.getItem("lastTimeStamp");
         var storedTimeStamp = sessionStorage.getItem("lastTimeStamp");
        timeCompare(storedTimeStamp);
    }, 3000);
}


function timeCompare(timeString) {
    var maxMinutes = 2; //GREATER THEN 1 MIN.
    var popMinutes = 1; 
    var currentTime = new Date();
    var pastTime = new Date(timeString);
    var timeDiff = currentTime - pastTime;
    var minPast = Math.floor((timeDiff / 60000));
    var popTime = Math.floor((timeDiff / 60000));
   


    if (minPast > maxMinutes) {
        sessionStorage.removeItem("lastTimeStamp");

            Swal.fire({
            title: 'Your session is about to timeout',
            //text: "You have been logged out",
            //icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Continue',
            cancelButtonText: 'Cancel'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location = "/logout";
            }
            })
    // }if(minPast > maxMinutes)

    //     sessionStorage.removeItem("lastTimeStamp");
    //     window.location = "/logout";
    //     return false;
    } else {
        // if(minPast > maxMinutes)

        // sessionStorage.removeItem("lastTimeStamp");
        // window.location = "/logout";
        // return false;
        //JUST ADDED AS A VISUAL CONFIRMATION
        console.log(currentTime + " - " + pastTime + " - " + minPast + " min past" );
    }

}

if (typeof(Storage) !== "undefined") {
    $(document).mousemove(function() {
        var timeStamp = new Date();
        sessionStorage.setItem("lastTimeStamp", timeStamp);
    });

    timeChecker();
}
}); //END JQUERY
</script>


                   <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <span class="ti-id-badge" style="font-size: 20px"></span>
                                            </div>
                                            <h5 class="font-16 text-uppercase mt-0 text-white-50">Total <br> Employees</h5>
                                            {{-- <h4 class="font-500">{{$data[0]}} </h4> --}}
                                            <h4 class="font-500"> {{ $emplCount }} </h4>
                                            {{-- <span class="ti-user" style="font-size: 71px"></span> --}}
                                              
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="/employees" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
                                            <p class="text-white-50 mb-0">More info</p>
                                        </div>
                                    </div>
                                </div>   
                                
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <i class="ti-alarm-clock" style="font-size: 20px"></i>
                                            </div>
                                            <h6  class="font-16 text-uppercase mt-0 text-white-50" >Total <br> Roles</h6>
                                            {{-- <h4 class="font-500">{{$data[3]}} %<i class="text-danger ml-2"></i></h4> --}}
                                            <h4 class="font-500">{{ $positionCount }}<i class="text-danger ml-2"></i></h4>
                                            
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="{{route('positions')}}" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
        
                                            <p class="text-white-50 mb-0">More info</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <i class=" ti-check-box " style="font-size: 20px"></i>
                                            </div>
                                            <h5 class="font-16 text-uppercase mt-0 text-white-50">Duty <br> Stations</h5>
                                            {{-- <h4 class="font-500">{{$data[1]}} <i class=" text-success ml-2"></i></h4> --}}
                                            <h4 class="font-500"> {{ $stationCount }} <i class=" text-success ml-2"></i></h4>
                                            {{-- <span class="peity-donut" data-peity='{ "fill": ["#02a499", "#f2f2f2"], "innerRadius": 28, "radius": 32 }' data-width="72" data-height="72">{{$data[1]}}/{{count($data)}}</span>
                                              --}}
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="{{route('stations')}}" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
        
                                            <p class="text-white-50 mb-0">More info</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stat bg-primary text-white">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <div class="float-left mini-stat-img mr-4">
                                                <i class="ti-alert" style="font-size: 20px"></i>
                                            </div>
                                            <h5 class="font-16 text-uppercase mt-0 text-white-50">Total <br> Vehicles</h5>
                                            {{-- <h4 class="font-500">{{$data[2]}}<i class=" text-success ml-2"></i></h4> --}}
                                            <h4 class="font-500">{{ $vehicleCount }}<i class=" text-success ml-2"></i></h4>
                                            {{-- <span class="peity-donut" data-peity='{ "fill": ["#02a499", "#f2f2f2"], "innerRadius": 28, "radius": 32 }' data-width="72" data-height="72">{{$data[2]}}/{{count($data)}}</span>
                                              --}}
                                        </div>
                                        <div class="pt-2">
                                            <div class="float-right">
                                                <a href="{{route('vehicles')}}" class="text-white-50"><i class="mdi mdi-arrow-right h5"></i></a>
                                            </div>
        
                                            <p class="text-white-50 mb-0">More info</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
 
                        </div>
                        <!-- end row -->

@endsection

@section('script')
<!--Chartist Chart-->
<script src="{{ URL::asset('plugins/chartist/js/chartist.min.js') }}"></script>
<script src="{{ URL::asset('plugins/chartist/js/chartist-plugin-tooltip.min.js') }}"></script>
<!-- peity JS -->
<script src="{{ URL::asset('plugins/peity-chart/jquery.peity.min.js') }}"></script>
<script src="{{ URL::asset('assets/pages/dashboard.js') }}"></script>
@endsection