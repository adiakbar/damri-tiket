@extends('layout.mainLayout')

@section('content')

<h2 class="content-title">Log Tiket</h2>
@if(Auth::user()->level == 'superadmin' || Auth::user()->level == 'root' || Auth::user()->level == 'kasir')
<a href="{{ url('log-pesanan') }}" style="font-size:12px;">Log Tiket</a> |
<a href="{{ url('log-petugas') }}" style="font-size:12px;">Log Petugas</a>
@endif
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
				<button type="submit" class="btn btn-primary" style="margin-top: 25px;">Submit</button>
			</div>

			<div class="col-md-2">
				<p>Petugas:</p>
				<h3 style="margin-top: 0;">{{ $profil->petugas }}</h3>
			</div>
			<div class="col-md-4">
				<div class="total-penjualan">{{ "Rp ".number_format($jumlah[0]->jumlah,0,',','.') }}</div>
				<div class="jumlah-penjualan">{{ $jumlah[0]->total.' Tiket' }}</div>
				
			</div>
		</div>
		
		
	</form>
</div>

<div class="box-content">
	<div class="table-responsive">
		<table class="table table-hover" id="table-log">
			<thead>
				<tr>
					<th>No.</th>
					<th>Penumpang</th>
					<th>Telepon</th>
					<th>Nomor Kursi</th>
					<th>Numeratur</th>
					<th>Trayek</th>
					<th>Harga</th>
					<th>Timestampt</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				@foreach($detail as $key => $value)
				<tr>
					<td>{{ $i }}</td>
					<td>{{ $value->penumpang }}</td>
					<td>{{ $value->telephone }}</td>
					<td>{{ $value->nomor_kursi }}</td>
					<td>{{ $value->numeratur }}</td>
					<td>{{ $value->jenis_bis_trayek->stasiun_asal.' - '.$value->jenis_bis_trayek->stasiun_tujuan }}</td>
					<td>{{ "Rp ".number_format($value->jenis_bis_trayek->harga,0,',','.') }}</td>
					<td>{{ $value->updated_at }}</td>
				</tr>
				<?php $i++; ?>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection

@section('script')
<script type="text/javascript">
	$('#table-log').DataTable({"iDisplayLength": 100});

	$('.datepicker').datepicker({
	    format: 'dd-mm-yyyy',
	    autoclose: true
	});

</script>
@endsection