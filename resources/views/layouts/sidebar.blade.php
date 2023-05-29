      <!-- ========== Left Sidebar Start ========== -->
      <div class="left side-menu">
        <div class="slimscroll-menu" id="remove-scroll">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                
                <!-- Left Menu Start -->
                <ul class="metismenu" id="side-menu">
                    <li class="menu-title">Main</li>
                    <li class="">
                        <a href="{{route('admin')}}" class="waves-effect {{ request()->is("admin") || request()->is("admin/*") ? "mm active" : "" }}">
                            <i class="ti-home"></i><span> Dashboard </span>
                        </a>
                    </li>

                    @if(Auth::user()->role=='Station-Incharge')
                    <li>
                        <a href="{{  route('stationemployees') }}" class="waves-effect {{ request()->is("stationemployees") || request()->is("/stationemployees/*") ? "mm active" : "" }}"><i class="dripicons-view-apps"></i><span>Manage Staffs</span></a>
                    </li>
                    @endif

                    @if(Auth::user()->role=='1')
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i><span> Staffs <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li>
                                <a href="/employees" class="waves-effect {{ request()->is("employees") || request()->is("/employees/*") ? "mm active" : "" }}"><i class="dripicons-view-apps"></i><span>Manage Staffs</span></a>
                            </li>
                            {{-- @if(Auth::user()->role=='1')
                            <li>
                                <a href="{{route('drivers')}}" class="waves-effect {{ request()->is("drivers") || request()->is("/drivers/*") ? "mm active" : "" }}"><i class="dripicons-view-apps"></i><span>Manage Drivers </span></a>
                            </li>
                            @endif --}}
                            <li>
                                <a href="{{route('driverlogs')}}" class="waves-effect {{ request()->is("driverlogs") || request()->is("/driverlogs/*") ? "mm active" : "" }}"><i class="dripicons-view-apps"></i><span>Employee Logs</span></a>
                            </li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('payments_list')}}" class="waves-effect {{ request()->is("payments_list") || request()->is("/payments_list/*") ? "mm active" : "" }}"><i class="dripicons-view-apps"></i><span>Current PayRoll</span></a>
                    </li>
                    <li>
                        <a href="{{route('paylist')}}" class="waves-effect {{ request()->is("paylist") || request()->is("/paylist/*") ? "mm active" : "" }}"><i class="dripicons-view-apps"></i><span>PayRoll History</span></a>
                    </li>
                    
                    @endif

                    @if(Auth::user()->role=='Data-Clerk')
                    <li class="">
                        <a href="/schedule" class="waves-effect {{ request()->is("schedule") || request()->is("schedule/*") ? "mm active" : "" }}">
                            <i class="ti-time"></i> <span> Attendance </span>
                        </a>
                    </li>

                    <li class="">
                        <a href="/leave" class="waves-effect {{ request()->is("leave") || request()->is("leave/*") ? "mm active" : "" }}">
                            <i class="dripicons-backspace"></i> <span> Leave </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/overtime" class="waves-effect {{ request()->is("overtime") || request()->is("overtime/*") ? "mm active" : "" }}">
                            <i class="dripicons-alarm"></i> <span> Over Time </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('upload')}}" class="waves-effect {{ request()->is("upload") || request()->is("upload/*") ? "mm active" : "" }}">
                              <i class="dripicons-view-apps"></i> <span> File Uploads </span>
                        </a>
                    </li>
                    @endif
                   

                    @if(Auth::user()->role=='1')


                    <li class="menu-title">Management</li>
                    
                     <li class="">
                        <a href="{{route('positions')}}" class="waves-effect {{ request()->is("positions") || request()->is("positions/*") ? "mm active" : "" }}">
                            <i class="dripicons-view-apps"></i> <span> Job Positions </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/schedule" class="waves-effect {{ request()->is("schedule") || request()->is("schedule/*") ? "mm active" : "" }}">
                            <i class="ti-time"></i> <span> Attendance </span>
                        </a>
                    </li>
                   
                    {{-- <li class="">
                        <a href="/check" class="waves-effect {{ request()->is("check") || request()->is("check/*") ? "mm active" : "" }}">
                            <i class="dripicons-to-do"></i> <span> Attendance Sheet </span>
                        </a>
                    </li> --}}
                    {{-- <li class="">
                        <a href="/sheet-report" class="waves-effect {{ request()->is("sheet-report") || request()->is("sheet-report/*") ? "mm active" : "" }}">
                            <i class="dripicons-to-do"></i> <span> Sheet Report </span>
                        </a>
                    </li> --}}

                    {{-- <li class="">
                        <a href="/attendance" class="waves-effect {{ request()->is("attendance") || request()->is("attendance/*") ? "mm active" : "" }}">
                            <i class="ti-calendar"></i> <span> Attendance Logs </span>
                        </a>
                    </li> --}}
                    {{-- <li class="">
                        <a href="/latetime" class="waves-effect {{ request()->is("latetime") || request()->is("latetime/*") ? "mm active" : "" }}">
                            <i class="dripicons-warning"></i><span> Late Time </span>
                        </a>
                    </li> --}}
                    <li class="">
                        <a href="/leave" class="waves-effect {{ request()->is("leave") || request()->is("leave/*") ? "mm active" : "" }}">
                            <i class="dripicons-backspace"></i> <span> Leave </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/overtime" class="waves-effect {{ request()->is("overtime") || request()->is("overtime/*") ? "mm active" : "" }}">
                            <i class="dripicons-alarm"></i> <span> Over Time </span>
                        </a>
                    </li>
                  
                    {{-- <li class="">
                        <a href="/overtime" class="waves-effect {{ request()->is("overtime") || request()->is("overtime/*") ? "mm active" : "" }}">
                            <i class="dripicons-alarm"></i> <span> Over Time </span>
                        </a>
                    </li> --}}

                    @endif

                    @if(Auth::user()->role=='1')
                   
                   
                    <li class="">
                        <a href="{{route('vehicles')}}" class="waves-effect {{ request()->is("vehicles") || request()->is("vehicles/*") ? "mm active" : "" }}">
                            <i class="dripicons-view-apps"></i> <span> Vehicles </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('stations')}}" class="waves-effect {{ request()->is("stations") || request()->is("stations/*") ? "mm active" : "" }}">
                            <i class="dripicons-view-apps"></i> <span> Duty Stations </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{route('upload')}}" class="waves-effect {{ request()->is("upload") || request()->is("upload/*") ? "mm active" : "" }}">
                              <i class="dripicons-view-apps"></i> <span> File Uploads </span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/sheet-report" class="waves-effect {{ request()->is("sheet-report") || request()->is("sheet-report/*") ? "mm active" : "" }}">
                            <i class="dripicons-to-do"></i> <span> Attendance Tracker </span>
                        </a>
                    </li>

                   
                    {{-- <li class="">
                        <a href="{{route('stationsincharge')}}" class="waves-effect {{ request()->is("stationsincharge") || request()->is("stationsincharge/*") ? "mm active" : "" }}">
                            <i class="dripicons-view-apps"></i> <span> Stations Incharge</span>
                        </a>
                    </li> --}}
                    
        
                    
                    @if(Auth::user()->role=='1')
                    <li class="menu-title">Users</li>
                    <li class="">
                        <a href="{{route('users')}}" class="waves-effect {{ request()->is("users") || request()->is("users/*") ? "mm active" : "" }}">
                            <i class="ti-user"></i> <span> Users </span>
                        </a>
                    </li>
                    @endif
                    
                   
                    @endif
                   
                    @if(Auth::user()->role=='Data-Clerk')
                    <li class="menu-title">Users</li>
                    <li class="">
                        <a href="{{  route('clerkpassword' ) }}" class="waves-effect {{ request()->is("users") || request()->is("users/*") ? "mm active" : "" }}">
                            <i class="fa fa-key"></i> <span> Change Password </span>
                        </a>
                    </li>
                    @endif
                </ul>

            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->
