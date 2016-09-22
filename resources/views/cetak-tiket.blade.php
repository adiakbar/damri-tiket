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
			<h1 class="box-logo-title" style="font-size:18px;">Perusahaan Umum (Perum) Damri </h1>
			<p class="box-logo-caption">Karcis Bis Antarkota</p>
		</div>
		<div class="text-numeratur">{{ $value->numeratur }}</div>
		<p class="text-label">Nama</p>
		<p>{{ $value->penumpang }}</p>
		<div class="row">
			<div class="col-xs-6">
				<p class="text-label">Dari</p>
				<p>{{ $value->jenis_bis_trayek->stasiun_asal }}</p>
			</div>
			<div class="col-xs-6">
				<p class="text-label">Tujuan</p>
				<p>{{ $value->jenis_bis_trayek->stasiun_tujuan }}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6">
				<p class="text-label">Tanggal</p>
				<p>{{ App\Convert::TanggalIndo($value->tanggal) }}</p>
			</div>
			<div class="col-xs-6">
				<p class="text-label">Harga</p>
				<p>{{  "Rp ".number_format($value->jenis_bis_trayek->harga,0,',','.')  }}</p>
			</div>
		</div>
		<p class="text-keterangan">Termasuk iuran wajib dana kecelakaan PNP sesuai dengan UU NO. 33/1964 No. 17/65 Perum AK. Jasa Raharja Sebesar Rp. 60</p>
		<div class="box-detail-bis">
			<div class="text-nomor-bis">{{ ($value->nomor_bis == 'Bis Default' ? '-' : $value->nomor_bis) }}</div>
			<div class="text-jenis-bis">{{ $value->jenis_bis_trayek->jenis_bis->jenis }}</div>
			<div>Jam: {{ $value->jenis_bis_trayek->jadwal }}</div>
			<div class="text-kursi">Nomor Kursi: {{ $value->nomor_kursi }}</div>
		</div>
		<p class="text-keterangan">Simpan Karcis ini baik-baik. Sewaktu-waktu ditunjukan apabila ada pemeriksaan</p>
	</div>
	<div style="page-break-after:always;"></div>
	@endforeach
</body>
</html>