<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body onLoad="window.print()">
<!-- <body> -->

	@foreach($pesanan as $value)
	<div class="box-tiket-cetak">
		<div class="box-logo">
			<img class="box-logo-image" src="img/damri-logo.png" style="width: 45px;">
			<h1 class="box-logo-title">Damri Kalimantan Barat</h1>
			<p class="box-logo-caption">Sistem Tiket Bis Online</p>
		</div>
		<p class="text-labelbis">{{ $value->jenis_bis_trayek->jenis_bis->jenis }}</p>
			<p class="text-labelkursi">{{ $value->nomor_kursi }}</p>
			<p class="text-label">{{ App\Convert::TanggalIndo($value->tanggal) }}</p>
			<p style="font-size:12px;">{{ $value->jenis_bis_trayek->stasiun_asal.' - '.$value->jenis_bis_trayek->stasiun_tujuan }}</p>
			<p class="text-label">Nama</p>
			<p>{{ $value->penumpang }}</p>
			<div class="row">
				<div class="col-xs-6">
					<p class="text-label">Telepon</p>
					<p>{{ $value->telephone }}</p>
				</div>
				<div class="col-xs-6">
					<p class="text-label">Status</p>
					<p id="{{ 'status-tiket-'.$value->id }}">{{ ucfirst($value->status) }}</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p class="text-label">Harga</p>
					<p>{{  "Rp ".number_format($value->jenis_bis_trayek->harga,0,',','.')  }}</p>
				</div>
				<div class="col-xs-6">
					<p class="text-label">Kode Tiket</p>
					<p id="{{ 'kode-tiket-'.$value->id }}">{{ ($value->numeratur == '' ? '-' : $value->numeratur) }}</p>
				</div>
			</div>

			<p class="text-label">Passport</p>
			<p>{{ ($value->passport == '' ? '-' : $value->passport) }}</p>
			<p class="text-label">Keterangan</p>
			<p>{{ ($value->keterangan  == '' ? '-' : $value->keterangan) }}</p>
	</div>

	@endforeach
</body>
</html>