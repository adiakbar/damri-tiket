@extends('layout.mainLayout')

@section('content')

<h2 class="content-title">Petugas</h2>

<div class="row">
	<div class="col-md-6">
		<div class="box-content">
			<div style="float:left; margin-right: 20px;">
				<img src="{{ url('img/user-icon.png') }}">
			</div>
			<p><b>Nama : </b> {{Auth::user()->petugas}}</p>
			<p><b>Username : </b> {{Auth::user()->username}}</p>
			<p><b>Email : </b> {{Auth::user()->email}}</p>
			<p><b>Level :</b> {{Auth::user()->level}}</p>
		</div>
		<div class="box-content">
			<h4 style="color: #3498db; display:inline-block">Update Password</h4>
			<form action="{{ url('reset-password') }}" method="POST">
					<div class="form-group">
						<label for="">Password Baru</label>
						<input type="password" name="password" class="form-control" required="">
					</div>
					<input type="hidden" name="id" value="{{ Auth::user()->id }}">
					<input type="hidden" name="level" value="{{ Auth::user()->level }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="submit" value="Reset Password" class="btn btn-primary">
				</form>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box-content">
			<form action="{{ url('update-petugas') }}" method="POST" role="form">
				<legend>Edit Petugas</legend>
			
				<div class="form-group">
					<label for="">Nama Petugas</label>
					<input type="text" class="form-control" name="petugas" value="{{ Auth::user()->petugas }}">
				</div>

				<div class="form-group">
					<label for="">Email</label>
					<input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
				</div>

				<div class="form-group">
					<label for="">Username</label>
					<input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}">
				</div>

				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="id" value="{{ Auth::user()->id }}">
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>

@endsection