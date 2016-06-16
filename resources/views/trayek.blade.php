@extends('layout.mainLayout')

@section('content')

<h2 class="content-title">Manajemen Trayek</h2>

<div class="row">
	
	<!-- col-md-6 -->
	<div class="col-md-5">
		<div class="box-content">
			<h4 style="color: #3498db;">Trayek</h4>
			@if(Auth::user()->level == 'root')
			<form action="{{ url('trayek') }}" method="POST" role="form" style="margin-top:10px; margin-bottom: 20px;">
				
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
					    <input type="text" name="alias_asal" placeholder="Contoh: ptk" class="form-control">
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
					    <input type="text" name="alias_tujuan" placeholder="Contoh: stg" class="form-control">
					  </div>
					</div>
				</div>
				
				<input type="hidden" value="{{ csrf_token() }}" name="_token">
				<input type="submit" class="btn btn-primary" value="Tambah Trayek">
			</form>
			@endif
			<table class="table" style="font-size:12px;">
				<thead>
					<th>No.</th>
					<th>Asal</th>
					<th>Tujuan</th>
					<th>Alias</th>
					<th style="width:100px;"></th>
				</thead>
				<tbody>
					@foreach($Trayek as $key => $value)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td>{{ $value->asal }}</td>
							<td>{{ $value->tujuan }}</td>
							<td>{{ $value->alias }}</td>
							<td>
								<a href="{{ url('/trayek?trayek_id='.$value->id) }}">Detail</a>
								@if(Auth::user()->level == 'root')
								|	<a href="#" onclick="deleteTrayek({{$value->id}})">Delete</a>
								@endif
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
			<h4 style="color: #3498db; margin-bottom: 15px;">Detail Trayek</h4>
			@if(isset($BisTrayek))
				<h5 class="title-trayek">{{ $trayek->alias }}</h5>
				@if(Auth::user()->level == 'root')
				<form action="{{ url('/detail-trayek') }}" method="POST" style="margin-top: 10px;">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Stasiun Asal</label>
								<input type="text" name="stasiun_asal" placeholder="Stasiun Asal" class="form-control">
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Stasiun Tujuan</label>
								<input type="text" name="stasiun_tujuan" placeholder="Stasiun Tujuan" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Jenis Bis</label>
								<select name="jenis_bis_id" id="" class="form-control">
									@foreach($jenisBis as $jenis)
									<option value="{{ $jenis->id }}">{{ $jenis->jenis }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group clockpicker">
								<label for="">Jadwal</label>
								<input type="text" name="jadwal" value="19:00" class="form-control">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Harga</label>
								<input type="text" name="harga" placeholder="Harga Tiket" class="form-control">
							</div>
						</div>
					</div>
					<input type="hidden" name="trayek_id" value="{{ $trayek->id }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="submit" value="Tambah Detail Trayek" class="btn btn-primary">
				</form>
				@endif

				<table class="table" style="margin-top:10px; font-size:12px;">
				<thead>
					<th style="width:10px;">No.</th>
					<th>Jenis Bis</th>
					<th style="width:150px;">Stasiun Asal</th>
					<th>Stasiun Tujuan</th>
					<th style="width:80px;">Jadwal</th>
					<th style="width:80px;">Harga</th>
				</thead>
				<tbody>
					@foreach($BisTrayek as $index => $stasiun)
					<tr>
						<td>{{ $index+1 }}</td>
						<td>{{ $stasiun->jenis_bis->jenis }}</td>
						<td>{{ $stasiun->stasiun_asal }}</td>
						<td>{{ $stasiun->stasiun_tujuan }}</td>
						<td>{{ $stasiun->jadwal.' WIB' }}</td>
						<td>{{ "Rp ".number_format($stasiun->harga,0,',','.') }}</td>
						<td>
							@if(Auth::user()->level == 'root')
							<a href="#" onclick="deleteDetailTrayek({{$stasiun->id}})">Delete</a>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@endif
		</div>
	</div>
	<!-- end col-md-6 -->

</div>

@endsection

@section('script')

<script type="text/javascript">
	$('.clockpicker').clockpicker();

	function deleteTrayek(id)
	{
		var c = confirm("Apakah anda yakin ingin menghapus trayek ini?");
		if(c == true)
		{
			window.location = base_url+'/delete-trayek/'+id;
		}
	}

	function deleteDetailTrayek(id)
	{
		var c = confirm("apakah anda yakin ingin menghapus detail trayek ini?");
		if(c == true)
		{
			window.location = base_url+'/delete-detail-trayek/'+id;
		}
	}
</script>

@endsection