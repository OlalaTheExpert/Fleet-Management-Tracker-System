<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Fleet Management System :: Employees Dashboard</title>
		
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ URL::asset('assets1/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ URL::asset('assets1/css/font-awesome.min.css') }}">
		
		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ URL::asset('assets1/css/line-awesome.min.css') }}">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{ URL::asset('assets1/css/select2.min.css') }}">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{ URL::asset('assets1/css/bootstrap-datetimepicker.min.css') }}">
		<!-- Datatable CSS -->
		<link rel="stylesheet" href="{{ URL::asset('assets1/css/dataTables.bootstrap4.min.css') }}">
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ URL::asset('assets1/css/style.css') }}">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
	<body>
		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Loader -->
			{{-- <div id="loader-wrapper">
				<div id="loader">
					<div class="loader-ellips">
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					  <span class="loader-ellips__dot"></span>
					</div>
				</div>
			</div> --}}
			<!-- /Loader -->
		
			<!-- Header -->
			<div class="header">
			
				<!-- Logo -->
				{{-- <div class="header-left">
					<a href="index.html" class="logo">
						<img src="{{ URL::asset('assets1/img/logo.png') }}" width="40" height="40" alt="">
					</a>
				</div> --}}
				<!-- /Logo -->
				
				<a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>
				
				<!-- Header Title -->
				<div class="page-title-box">
					<h3>Fleet Management</h3>
				</div>
				<!-- /Header Title -->
				
				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
				
				<!-- Header Menu -->
				<ul class="nav user-menu">
				
					<!-- Search -->
					<li class="nav-item">
						<div class="top-nav-search">
							<a href="javascript:void(0);" class="responsive-search">
								<i class="fa fa-search"></i>
						   </a>
							<form action="search.html">
								<input class="form-control" type="text" placeholder="Search here">
								<button class="btn" type="submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</li>
					<!-- /Search -->
				
				  
					<!-- /Flag -->
				
					<!-- Notifications -->
					<li class="nav-item dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i> <span class="badge badge-pill">3</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="assets/img/profiles/avatar-02.jpg">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
													<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="assets/img/profiles/avatar-03.jpg">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
													<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="assets/img/profiles/avatar-06.jpg">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
													<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="assets/img/profiles/avatar-17.jpg">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
													<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
									<li class="notification-message">
										<a href="activities.html">
											<div class="media">
												<span class="avatar">
													<img alt="" src="assets/img/profiles/avatar-13.jpg">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
													<p class="noti-time"><span class="notification-time">2 days ago</span></p>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="activities.html">View all Notifications</a>
							</div>
						</div>
					</li>
					<!-- /Notifications -->
					
					<!-- Message Notifications -->
				   
					<!-- /Message Notifications -->
	
					<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img"><img src="assets/img/profiles/avatar-21.jpg" alt="">
							<span class="status online"></span></span>
							<span>{{ auth()->user()->name }}</span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{  route('profile') }}">My Profile</a>
							<a class="dropdown-item" href="{{  route('password' ) }}">Settings</a>
					
							<a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
							document.getElementById('logout-form').submit();"><i class="mdi mdi-power text-danger"></i> {{ __('Logout') }}</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
						</div>
					</li>
				</ul>
				<!-- /Header Menu -->
				
				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="{{  route('profile') }}">My Profile</a>
						<a class="dropdown-item" href="{{  route('password' ) }}">Settings</a>
						<a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
							document.getElementById('logout-form').submit();"><i class="mdi mdi-power text-danger"></i> {{ __('Logout') }}</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</div>
				<!-- /Mobile Menu -->
				
			</div>
			<!-- /Header -->
			
			<!-- Sidebar -->
			<div class="sidebar" id="sidebar">
				<div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							{{-- <li class="submenu">
								<a href="#"><a class="active" href="{{ route('employeedashboard') }}"></a></li><span> Dashboard</span> <span class="menu-arrow"></span></a>
								
							</li> --}}
							<li> 
								<a href="#"><a class="{{ request()->is("employeedashboard") || request()->is("/employeedashboard/*") ? "active" : "" }}" href="{{ route('employeedashboard') }}"><i class="la la-dashboard"></i> <span> Dashboard</span></a>
							</li>
							@if(Auth::user()->role=='Station-Incharge')
                           
							<li class="class="waves-effect {{ request()->is("stationempl") || request()->is("/stationempl/*") ? "mm active" : "" }}""> 
								<a href="{{  route('stationempl' ) }}"><i class="la la-users"></i> <span>Employees</span></a>
							</li>
							@endif
							<li>
                                <a href="{{  route('profile') }}" class="waves-effect {{ request()->is("profile") || request()->is("/profile/*") ? "mm active" : "" }}"><i class="la la-user"></i><span>Profile</span></a>
                            </li>
							
							<li class="class="waves-effect {{ request()->is("password") || request()->is("/password/*") ? "mm active" : "" }}""> 
								<a href="{{  route('password' ) }}"><i class="la la-lock"></i> <span>Change Password</span></a>
							</li>
							
							
						   
						  
						</ul>
					</div>
				</div>
			</div>

    @yield('content')

</div>
<!-- /Main Wrapper -->

	<!-- Datatable JS -->
	<script src="{{ URL::asset('assets1/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::asset('assets1/js/dataTables.bootstrap4.min.js') }}"></script>
    	<!-- jQuery -->
        <script src="{{ URL::asset('assets1/js/jquery-3.5.1.min.js') }}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{ URL::asset('assets1/js/popper.min.js') }}"></script>
        <script src="{{ URL::asset('assets1/js/bootstrap.min.js') }}"></script>
		
		<!-- Slimscroll JS -->
		<script src="{{ URL::asset('assets1/js/jquery.slimscroll.min.js') }}"></script>
		
		<!-- Select2 JS -->
		<script src="{{ URL::asset('assets1/js/select2.min.js') }}"></script>
		
		<!-- Datetimepicker JS -->
		<script src="{{ URL::asset('assets1/js/moment.min.js') }}"></script>
		<script src="{{ URL::asset('assets1/js/bootstrap-datetimepicker.min.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{ URL::asset('assets1/js/app.js') }}"></script>
		
    </body>
</html>