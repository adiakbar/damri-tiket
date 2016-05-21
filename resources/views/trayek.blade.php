@extends('layout.mainLayout')

@section('content')

<h2 class="content-title">Manajemen Trayek</h2>

<div class="row">
	
	<!-- col-md-6 -->
	<div class="col-md-5">
		<div class="box-content">
			<h4 style="color: #3498db;">Trayek</h4>

			<form action="" role="form" style="margin-top:10px; margin-bottom: 20px;">
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
					    <label for="">Asal </label>
					    <input type="text" name="asal" placeholder="Contoh: Pontianak" class="form-control">
					  </div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
					    <label for="">Alias Asal </label>
					    <input type="text" name="alis_asal" placeholder="Contoh: ptk" class="form-control">
					  </div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
					    <label for="">Tujuan </label>
					    <input type="text" name="tujuan" placeholder="Contoh: Sintang" class="form-control">
					  </div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
					    <label for="">Alias Tujuan </label>
					    <input type="text" name="alis_tujuan" placeholder="Contoh: stg" class="form-control">
					  </div>
					</div>
				</div>
				
				<input type="submit" class="btn btn-primary" value="Tambah Trayek">
			</form>
		
			<table class="table">
				<thead>
					<th>No.</th>
					<th>Asal</th>
					<th>Tujuan</th>
					<th>Alias</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($trayek as $key => $value)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $value->asal }}</td>
							<td>{{ $value->tujuan }}</td>
							<td>{{ $value->alias }}</td>
							<td><a href="">Edit</a> | <a href="">Hapus</a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<!-- end col-md-6 -->

	<!-- col-md-6 -->
	<div class="col-md-7">
		<div class="box-content">
			<h4 style="color: #3498db; margin-bottom: 20px;">Detail Trayek</h4>

			@foreach($trayek as $key => $value)
			<h5 class="title-trayek">{{ $value->alias }}</h5>
			<table class="table" style="margin-top:10px;">
				<thead>
					<th>No.</th>
					<th>Jenis Bis</th>
					<th>Stasiun Asal</th>
					<th>Stasiun Tujuan</th>
					<th>Jadwal</th>
					<th>Harga</th>
				</thead>
				<tbody>
					@foreach($value->jenis_bis_trayek as $index => $stasiun)
					<tr>
						<td>{{ $index + 1}}</td>
						<td>{{ $stasiun->jenis_bis->jenis }}</td>
						<td>{{ $stasiun->stasiun_asal }}</td>
						<td>{{ $stasiun->stasiun_tujuan }}</td>
						<td>{{ $stasiun->jadwal }}</td>
						<td>{{ $stasiun->harga }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@endforeach
		</div>
	</div>
	<!-- end col-md-6 -->

</div>


@endsection