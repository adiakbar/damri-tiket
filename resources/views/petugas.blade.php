@extends('layout.mainLayout')

@section('content')

<h2 class="content-title" style="display: inline-block">Petugas</h2>

<div class="row">
	<div class="col-md-4">
		<div class="box-content">
			<form action="" method="POST" role="form">
				<legend>Tambah Petugas</legend>
			
				<div class="form-group">
					<label for="">Nama Petugas</label>
					<input type="text" class="form-control" name="petugas" placeholder="Nama Petugas">
				</div>

				<div class="form-group">
					<label for="">Email</label>
					<input type="email" class="form-control" name="email" placeholder="Email">
				</div>

				<div class="form-group">
					<label for="">Username</label>
					<input type="text" class="form-control" name="username" placeholder="Username">
				</div>
			
				<div class="form-group">
					<label for="">Password</label>
					<input type="password" class="form-control" name="password" placeholder="Password">
				</div>

				<div class="form-group">
					<label for="">Level</label>
					<select name="level" id="" class="form-control">
						<option value="petugas">Petugas</option>
						<option value="admin">Admin</option>
						<option value="kasir">Kasir</option>
						<option value="manager">Manager</option>
						<option value="superadmin">Superadmin</option>
					</select>
				</div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
	<div class="col-md-8">
		<div class="box-content">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Username</th>
						<th>Email</th>
						<th>Level</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($petugas as $key => $value)
					<tr>
						<td>{{ $key + 1 }}</td>
						<td>{{ $value->petugas }}</td>
						<td>{{ $value->username }}</td>
						<td>{{ $value->email }}</td>
						<td>{{ $value->level }}</td>
						<td>
							<button class="btn btn-xs btn-danger" onclick="btnDeletePetugas({{$value->id}})">Delete</button>
							<button class="btn btn-xs btn-default btn-modal" data-toggle="modal" data-target="#myModal" data-id="{{ $value->id }}" data-level="{{ $value->level }}">Reset Password</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>	
		</div>
	</div>
</div>

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Reset Password Petugas</h4>
			</div>
			<div class="modal-body">
				<form action="{{ url('reset-password') }}" method="POST">
					<div class="form-group">
						<label for="">Password Baru</label>
						<input type="password" name="password" class="form-control" required="">
					</div>
					<div class="form-group">
						<label for="">Level</label>
						<select name="level" id="modalLevel" class="form-control">
							<option value="petugas">Petugas</option>
							<option value="admin">Admin</option>
							<option value="manager">Manager</option>
							<option value="superadmin">Superadmin</option>
						</select>
					</div>
					<input type="hidden" name="id" id="modalId">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="submit" value="Reset Password" class="btn btn-primary">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>

@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$('.btn-modal').click(function() {
			var id = $(this).attr('data-id');
			var level = $(this).attr('data-level');
			
			$('#modalId').val(id);
			$('#modalLevel').val(level);
		});
	});
	function btnDeletePetugas(id)
	{
		var c = confirm("Apakah Anda yakin akan menghapus petugas ini?");
		if(c == true)
		{
			window.location = 'delete-petugas/'+id;
		}
		return false;
	}
</script>
@endsection