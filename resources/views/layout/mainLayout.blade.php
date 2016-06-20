<!DOCTYPE html>
<html>

<head>

	<title>Sistem Tiket Bis Online Perum Damri Kalimantan Barat</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Open+Sans:400,600'>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugin/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugin/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugin/bootstrap-clockpicker/dist/bootstrap-clockpicker.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('plugin/data-tables/media/css/dataTables.bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

</head>

<body>

<div class="cover" id="cover-responsive">
</div>

	<!-- sidebar -->
	<div id="sidebar">
		<ul class="sidebar-list">
			<li @if($menu == 'pesan-tiket') class="active" @endif>
				<a href="{{ url('/') }}" class="sidebar-list-link">
					<i class="fa fa-inbox sidebar-list-icon"></i>
					<div class="sidebar-list-title">Pesan Tiket</div>
				</a>
			</li>
			<li @if($menu == 'data-pesanan') class="active" @endif>
				<a href="{{ url('/pesanan') }}" class="sidebar-list-link">
					<i class="fa fa-list sidebar-list-icon"></i>
					<div class="sidebar-list-title">Data Pesanan</div>
				</a>
			</li>
			<li @if($menu == 'trayek') class="active" @endif>
				<a href="{{ url('trayek') }}" class="sidebar-list-link">
					<i class="fa fa-arrows sidebar-list-icon"></i>
					<div class="sidebar-list-title">Trayek</div>
				</a>
			</li>
			<li @if($menu == 'unit-bis') class="active" @endif>
				<a href="{{ url('bis-berangkat') }}" class="sidebar-list-link">
					<i class="fa fa-bus sidebar-list-icon"></i>
					<div class="sidebar-list-title">Unit Bis</div>
				</a>
			</li>
			@if(Auth::user()->level == 'superadmin' || Auth::user()->level == 'root')
			<li @if($menu == 'petugas') class="active" @endif>
				<a href="{{ url('petugas') }}" class="sidebar-list-link">
					<i class="fa fa-users sidebar-list-icon"></i>
					<div class="sidebar-list-title">Petugas</div>
				</a>
			</li>
			
			<li @if($menu == 'log') class="active" @endif>
				<a href="{{ url('log-pesanan') }}" class="sidebar-list-link">
					<i class="fa fa-th-large sidebar-list-icon"></i>
					<div class="sidebar-list-title">Log</div>
				</a>
			</li>
			@endif
			<li>
				<a href="{{ url('auth/logout') }}" class="sidebar-list-link">
					<i class="fa fa-sign-out sidebar-list-icon"></i>
					<div class="sidebar-list-title">Keluar</div>
				</a>
			</li>
		</ul>	
	</div>
	<!-- end-sidebar	 -->

	<!-- header -->
	<header id="header">
		<!-- box-logo -->
		<div class="box-logo">
        <img class="box-logo-image" src="img/damri-logo.png">
        <h1 class="box-logo-title">Perum Damri Kantor Cab. Pontianak</h1>
        <h2 class="box-logo-title">Kalimantan Barat</h2>
        <p class="box-logo-caption">Damri Online System</p>
    </div>
		<!-- end-box-logo -->
		<div class="collapse-icon" id="collapse-icon">
			<i class="fa fa-bars"></i>
		</div>
		<!-- box-user -->
		<div class="box-user">
			<span><a href="{{ url('/petugas-detail') }}">Hello, {{ Auth::user()->petugas }}</a></span>
			<img class="box-user-icon" src="{{ url('img/user-icon.png') }}  " style="width: 45px;">
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
	<script type="text/javascript" src="{{ asset('plugin/bootstrap-clockpicker/dist/bootstrap-clockpicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugin/data-tables/media/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugin/data-tables/media/js/dataTables.bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('plugin/jquery.cycle.all.js') }}"></script>
	<script type="text/javascript">
		var base_url = window.location.origin;
		$(document).ready(function() {
			$("#collapse-icon").click(function() {
				$('#sidebar').animate({"left":"0px"}, "medium");
				$('#cover-responsive').show();
			});
			$("#cover-responsive").click(function() {
				$('#sidebar').animate({"left":"-100px"}, "medium");
				$('#cover-responsive').hide();
			})
		});
	</script>
	@yield('script')

</body>

</html>