<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body onLoad="window.print()">
{{-- <body> --}}

	@foreach($pesanan as $key => $value)
	<table class="table-etiket">
		<tr>
			<td rowspan="8" class="etiket-rotate"><div>{{ $value->numeratur }}</div></td>
			<td colspan="4" style="padding: 10px;">

				<div class="etiket-title">
					<h4>E-Tiket Perum DAMRI</h4>
					<p>Kantor Cabang Pontianak</p>
				</div>
				<div class="etiket-logo">
					<img src="img/damri-logo.png">
				</div>
			</td>	
		</tr>
		<tr>
			<td colspan="2">
				<div class="etiket-span"> <strong>Nama Pelanggan</strong> <br> <span>(Name of Passanger)</span></div> 
				<div class="etiket-text"> : {{$value->penumpang}}</div> 
			</td>
			<td rowspan="4" style="width: 200px; text-align: center">
				<div class="etiket-text-nomor-bis">{{ ($value->nomor_bis == 'Bis Default' ? '-' : $value->nomor_bis) }}</div>
				<div class="etiket-text-jenis-bis">{{ $value->jenis_bis_trayek->jenis_bis->jenis }}</div>
				<div class="etiket-text-kursi">Nomor Kursi: {{ $value->nomor_kursi }}</div>
				<div style="font-weight: 700; font-size: 14px;">Jam: {{ $value->jenis_bis_trayek->jadwal }}</div>
				
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<div class="etiket-span"> <strong>No. Handphone</strong> <br> <span>(Phone)</span></div> 
				<div class="etiket-text"> : {{$value->telephone}}</div> 
			</td>
		</tr>
		<tr>
			<td>
				<div class="etiket-span"> <strong>Dari</strong> <br> <span>(From)</span></div> 
				<div class="etiket-text"> : {{$value->jenis_bis_trayek->stasiun_asal}}</div> 
			</td>
			<td>
				<div class="etiket-span"> <strong>Ke</strong> <br> <span>(To)</span></div> 
				<div class="etiket-text"> : {{$value->jenis_bis_trayek->stasiun_tujuan}}</div> 
			</td>
		</tr>
		<tr>
			<td>
				<div class="etiket-span"> <strong>Tanggal</strong> <br> <span>(Date)</span></div> 
				<div class="etiket-text"> : {{\App\Convert::TanggalIndo($value->tanggal)}}</div> 
			</td>
			<td>
				<div class="etiket-span"> <strong>Tarif</strong> <br> <span>(Price)</span></div> 
				<div class="etiket-text"> : {{ "Rp ".number_format($value->jenis_bis_trayek->harga,0,',','.') }}</div> 
			</td>
		</tr>
		<tr>
			
		</tr>
		<tr>
			<td colspan="3">
				<ol class="etiket-list-keterangan">
					<li>Termasuk iuran wajib Dana Kecelakaan Penumpang sesuai dengan UU No. 33/1964 yo.PP 17/65 Perum AK JASA RAHARJA sebesar Rp. 60,-</li>
					<li>Simpan e-tiket ini baik-baik,sewaktu- waktu diperlukan dalam pemeriksaan</li>
					<li>Para penumpang wajib memiliki e-tiket yang sah atas namanya sendiri sesuai dengan tanggal keberangkatan</li>
					<li>Pemegang e-tiket wajib hadir 30 menit sebelum waktu keberangkatan yang tertera</li>
					<li>Pembatalan keberangkatan dapat dilayani apabila dilaporkan 8 jam sebelum waktu keberangkatan dan akan dipotong 25% untuk biaya administrasi.</li>
					<li>Proses refund uang tiket dapat diambil 1 (satu) hari setelah proses pembatalan dengan menunjukkan form/blanko yang telah dilengkapi sebelumnya</li>
					<li>Barang bawaan yang beratnya melebihi 15kg akan dikenakan biaya bagasi sebesar Rp.3500,- /kg</li>
					<li>Semua barang bawaan menjadi tanggung jawab masing-masing penumpang apabila terjadi kerusakan, tertukar maupun hilang</li>
					<li>Barang bagasi hanya diperbolehkan barang makanan dan atau pakaian saja</li>
				</ol>
			</td>
		</tr>
	</table>
	@if($key % 3 == 0 && $key != 0)
	<div style="page-break-after:always;"></div>
	@endif
	@endforeach
</body>
</html>