<!DOCTYPE html>
<html>

<head>

	<title>Sistem Tiket Bis Online Perum Damri Kalimantan Barat</title>

	<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Open+Sans:400,600'>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugin/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugin/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

</head>

<body>

	<!-- sidebar -->
	<div id="sidebar">
		<ul class="sidebar-list">
			<li class="active">
				<a href="{{ url('/') }}" class="sidebar-list-link">
					<i class="fa fa-inbox sidebar-list-icon"></i>
					<div class="sidebar-list-title">Pesan Tiket</div>
				</a>
			</li>
			<li>
				<a href="#" class="sidebar-list-link">
					<i class="fa fa-list sidebar-list-icon"></i>
					<div class="sidebar-list-title">Data Pesanan</div>
				</a>
			</li>
			<li>
				<a href="{{ url('trayek') }}" class="sidebar-list-link">
					<i class="fa fa-arrows sidebar-list-icon"></i>
					<div class="sidebar-list-title">Trayek</div>
				</a>
			</li>
			<li>
				<a href="#" class="sidebar-list-link">
					<i class="fa fa-bus sidebar-list-icon"></i>
					<div class="sidebar-list-title">Unit Bis</div>
				</a>
			</li>
			<li>
				<a href="#" class="sidebar-list-link">
					<i class="fa fa-users sidebar-list-icon"></i>
					<div class="sidebar-list-title">Petugas</div>
				</a>
			</li>
			<li>
				<a href="#" class="sidebar-list-link">
					<i class="fa fa-settings sidebar-list-icon"></i>
					<div class="sidebar-list-title">Log</div>
				</a>
			</li>
		</ul>	
	</div>
	<!-- end-sidebar	 -->

	<!-- header -->
	<header id="header">
		<!-- box-logo -->
		<div class="box-logo">
			<img class="box-logo-image" src="img/damri-logo.png" style="width: 45px;">
			<h1 class="box-logo-title">Damri Kalimantan Barat</h1>
			<p class="box-logo-caption">Sistem Tiket Bis Online</p>
		</div>
		<!-- end-box-logo -->
		<!-- box-user -->
		<div class="box-user">
			<span>Hello, Admin Sistem</span>
			<img class="box-user-icon" src="img/user-icon.png" style="width: 45px;">
		</div>
		<!-- end-box-user -->
	</header>

	<div id="content">

		@yield('content')

	</div>
	
	<script type="text/javascript" src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugin/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugin/jquery.cycle.all.js') }}"></script>
	@yield('script')

</body>

</html>