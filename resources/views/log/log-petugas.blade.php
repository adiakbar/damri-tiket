@extends('layout.mainLayout')

@section('content')

<h2 class="content-title">Log Tiket</h2>
<a href="{{ url('log-pesanan') }}" style="font-size:12px;">Log Tiket</a> |
<a href="{{ url('log-petugas') }}" style="font-size:12px;">Log Petugas</a> |
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
				<button type="submit" class="btn btn-primary" style="margin-top: 25px;">Submit</button>
			</div>
		
		</div>
		
		
	</form>
</div>

<div class="box-content">
	<div class="row">
		@foreach($jml_tiket as $key => $value)
		<div class="col-md-2 col-xs-6">
			<div class="box-jml-penjualan" >
				<i class="fa fa-user"> {{ $value->petugas }}</i>
				<div class="total-penjualan">{{ $value->total.' Tiket' }}</div>
				<div class="jumlah-penjualan">{{ "Rp ".number_format($value->jumlah,0,',','.') }}</div>
				<a href="{{ url('log-petugas/detail/'.$value->id.'?tanggal='.$tanggal) }}">Detail</a>
			</div>
		</div>
		@endforeach
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