<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		html {
			margin: 10px;
			font-size: 11px;
			/*margin-left: 20px;*/
		}
		table {
		    border-collapse: collapse;
		}

		table, th, td {
		    border: 1px solid black;
		    padding-left: 5px;
		    /*width: 100%;*/
		}
		h1,h2,h3,h4,h5,h6,p {
			margin: 0;
		}
		.table-header {
			width: 100%;
			margin-top: 20px;
		}
		.table-header,
		.table-header th,
		.table-header td{
			border: none;
		}
	</style>
</head>


	@foreach($pnpCash as $bus => $Penumpang)
	<h3 style="text-align: center;">PERUM UMUM DAMRI</h3>
	<h4 style="text-align: center;">(PERUM DAMRI)</h4>
	<h2 style="text-align: center; text-decoration:underline; margin-top: 10px;">DAFTAR MUATAN BUS</h2>
	<div style="position: absolute; font-size: 30px; left: 20px; top: 20px;" >{{$bus}}</div>
	<div style="position: absolute; left:540px; top: 20px;">
		<p><span style="width: 50px; display:inline-block" ;>Seri</span>: <b>H</b><span style="color:#c0392b;"> {{$seri[$bus]}} </span><b>AP/3</b></p>
		<p><span style="width: 50px; display:inline-block" ;>Nomor</span>: ..............................</p>
	</div>
	<table class="table-header">
		<tr>
			<td style="width: 30px;">Loket</td>
			<td style="width: 5px;">:</td>
			<td>..............................</td>
			<td style="width: 70px;">Bus Code</td>
			<td style="width: 5px;">:</td>
			<td>..............................</td>
			<td style="width: 30px;">Dari</td>
			<td style="width: 5px;">:</td>
			<td>{{ $data_trayek->trayek->asal }}</td>
		</tr>
		<tr>
			<td style="width: 30px;">Tanggal</td>
			<td style="width: 5px;">:</td>
			<td>{{ \App\Convert::TanggalIndo($tanggal) }}</td>
			<td style="width: 70px;">Formasi</td>
			<td style="width: 5px;">:</td>
			<td>..............................</td>
			<td style="width: 30px;">Ke</td>
			<td style="width: 5px;">:</td>
			<td>{{ $data_trayek->trayek->tujuan }}</td>
		</tr>
	</table>
	<table style="margin-top: 20px; margin-bottom: 10px; width: 100%;">
		<tr>
			<th style="width: 10px;" rowspan="2">No</th>
			<th rowspan="2">Nomor Karcis</th>
			<th colspan="2">Tujuan</th>
			<th rowspan="2" style="width: 30px;">TP. Duduk Nomor</th>
			<th colspan="3">Pendapatan Angkutan</th>
			<th rowspan="2" style="width: 10px;">Biaya Operasional / Transit</th>
			<th rowspan="2">Keterangan</th>
		</tr>
		<tr>
			<th>Dari</th>
			<th>Ke</th>
			<th>Bagasi</th>
			<th>Penumpang</th>
			<th style="width: 80px;">Jumlah</th>
		</tr>
		<tr style="text-align:center; background: #f1f1f1;">
			<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td>
		</tr>
		@foreach($Penumpang as $key => $penumpang)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{$penumpang->numeratur}}</td>
			<td>{{$penumpang->jenis_bis_trayek->stasiun_asal}}</td>
			<td>{{$penumpang->jenis_bis_trayek->stasiun_tujuan}}</td>
			<td>{{$penumpang->nomor_kursi}}</td>
			<td></td>
			<td>{{ "Rp ".number_format($penumpang->jenis_bis_trayek->harga,0,',','.') }}</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@endforeach
		@for($i=1; $i<=35-count($Penumpang); $i++)
		<tr>
			<td>{{$i+count($Penumpang)}}</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		@endfor
		<tr>
			<td>A.</td>
			<td colspan="3">Pendapatan Angkutan ................</td>
			<td>{{ $jmlPnp[$bus] }} Pnp</td>
			<td></td><td></td><td>{{ "Rp ".number_format($jmlHarga[$bus],0,',','.') }}</td><td></td><td></td>
		</tr>
	</table>
	<div style="margin-left: 10px;">
		<p >B. Biaya Titipan:</p>
		<p style="margin-left: 10px;">1. Asuransi Pnp Rp. 60,- x ............... Pnp <span style="margin-left: 100px;">Rp.........................</span></p>
		<p style="margin-left: 10px;">2. Penyebrangan: @Rp. .................... / pnp x Rp. ........... <span style="margin-left: 33px;">Rp.........................</span></p>
		<p style="margin-left: 10px;">3. Bantal, Selimut @Rp. ...................... / pnp x Rp. ........ <span style="margin-left: 33px;">Rp.........................</span></p>
		<p style="margin-left: 10px;">4. Snack @Rp. ............... / pnp x Rp. .............................. <span style="margin-left: 33px;">Rp........................+</span></p>
		<p style="padding-left: 250px; margin-top: 10px;" >Jumlah (B) : ...................................................................... <span style="margin-left: 20px;"> Rp. ....................</span></p>
		<p >C. Jumlah UPP-KM-BUS (A-B) <span style="margin-left: 30px;">......................................................................................................................</span> <span style="margin-left: 20px;"> Rp. ....................</span></p>
		<p>D. Komisi Transit / Agen ...... % dari UPP-Km-Bus <span style="margin-left: 30px;">.................................................... Rp. ............................</span></p>
		<p>E. PPh Agen 6% dari Komisi (D) <span style="margin-left: 30px;"> ....................................................................................................................</span> <span style="margin-left: 20px;"> Rp. .................... +</span></p>
		<p>F. Komisi yang diterima Agen (D - E) <span style="margin-left: 10px;"> ................................................................................ Rp. ............................ </span></p>
		<p>G. UPP yang diterima Crew (B+C+E+Operan/Transit) <span style="margin-left: 20px;">.......................................................................................</span> <span style="margin-left: 20px;">Rp. ....................</span></p>
		<div style="font-size: 8px; margin-top: 10px;">
			<p>Penjelasan</p>
			<p>1. Biaya Penyebrangan per-Pnp sesuai Perhitungan dari UPT yang bersangkutan</p>
			<p>a. Lembar kesatu untuk Crew</p>
			<p>b. Lembar kedua untuk UPT</p>
			<p>c. Lembar ketiga untuk arsip loket</p>
		</div>
		<div style="margin-top: 10px;">
			<p><span style="margin-left: 575px;">............,.................20</span></p>
			<p><span style="margin-left: 100px;">Yang Menerima</span> <span style="margin-left: 400px;">Yang Menyerahkan</span></p>
			<p style="margin-top: 30px;"><span style="margin-left: 80px;">.............................................</span><span style="margin-left: 370px;">.................................</span></p>
			<p style="margin-left: 90px;"">Crew Bus Code : .........</p>
		</div>
		
	</div>
	<div style="page-break-after:always;"></div>
	@endforeach
