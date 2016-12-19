@extends('layout.mainLayout')

@section('content')

<h2 class="content-title">Log Tiket</h2>
<a href="{{ url('log-pesanan') }}" style="font-size:12px;">Log Tiket</a> |
<a href="{{ url('log-petugas') }}" style="font-size:12px;">Log Petugas</a>
<a href="{{ url('log-petugas-harian') }}" style="font-size:12px;">Log Petugas Harian</a>

<div class="box-content">
	<form action="" method="GET" role="form">

		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Tanggal Tiket</label>
					<input type="text" name="tanggal" class="form-control datepicker"  id="" placeholder="Tanggal Tiket" value="{{ $tanggal }}">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Petugas</label>
					<select name="petugas" id="input" class="form-control selectpicker" data-live-search="true">
						<option value="">-- Pilih Petugas --</option>
						@foreach($Petugas as $key => $value)
						<option @if($petugas == $value) selected @endif value="{{ $value }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				
			</div>
			<div class="col-md-3">
				<button type="submit" class="btn btn-primary" style="margin-top: 25px;">Submit</button>
			</div>
		
		</div>
		
	</form>
	<br>

</div>

<div class="box-content">
	<div class="table-responsive">
		<table class="table table-hover" id="table-log" style="font-size:12px;">
			<thead>
				<tr>
					<th>Petugas</th>
					<th>Aktivitas</th>
					<th>Tanggal</th>
					<th>Numeratur</th>
					<th>Jenis Bis</th>
					<th>Jadwal</th>
					<th>Stasiun Asal</th>
					<th>Stasiun Tujuan</th>
					<th>Timestamp</th>
				</tr>
			</thead>
			<tbody>
				@foreach($log as $key => $log)
				<tr>
					<td>{{ $log->petugas }}</td>
					<td>{{ $log->aktivitas }}</td>
					<td>{{ \App\Convert::tgl_eng_to_ind($log->tanggal) }}</td>
					<td>{{ $log->numeratur }}</td>	
					<td>{{ $log->jenis_bis_trayek->jenis_bis->jenis }}</td>
					<td>{{ $log->jenis_bis_trayek->jadwal }}</td>
					<td>{{ $log->jenis_bis_trayek->stasiun_asal }}</td>
					<td>{{ $log->jenis_bis_trayek->stasiun_tujuan }}</td>
					<td>{{ $log->created_at }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection

@section('script')
<script type="text/javascript">
	$('#table-log').DataTable({
		"iDisplayLength": 100,
		"order": []
	});

	$('.datepicker').datepicker({
	    format: 'dd-mm-yyyy',
	    autoclose: true
	});

</script>
@endsection