<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		html {
			margin: 10px;
			font-size: 11px;
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
<body onLoad="window.print()">
{{-- <body> --}}
	@foreach($pnpCash as $bus => $Penumpang)
	<h3 style="text-align: center;">PERUM UMUM DAMRI</h3>
	<h4 style="text-align: center;">(PERUM DAMRI)</h4>
	<h2 style="text-align: center; text-decoration:underline; margin-top: 10px;">PASSENGER LIST</h2>

	<div style="display: inline-block; margin-top: -80px;">
		<p>Nama Driver 1: ................................. </p>
		<p>No. Passport : ................................. </p>
		<p>Nama Driver 2: ................................. </p>
		<p>No. Passport : ................................. </p>
	</div>
	
	<table class="table-header">
		<tr>
			<td style="width: 30px;">Loket</td>
			<td style="width: 5px;">:</td>
			<td>{{ $data_trayek->trayek->asal }}</td>
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
			<td>@if(isset($formasi[$bus]) && $formasi[$bus]->bis_id != 0) {{ $formasi[$bus]->bis->plat }} @endif</td>
			<td style="width: 30px;">Ke</td>
			<td style="width: 5px;">:</td>
			<td>{{ $data_trayek->trayek->tujuan }}</td>
		</tr>
	</table>
	@if($data_trayek->trayek->id == 6 || $data_trayek->trayek->id == 7)
	<table style="margin-top: 20px; margin-bottom: 10px; width: 100%;">
		<tr>
			<td>No.</td>
			<td>Nama Of Passanger</td>
			<td>Sex</td>
			<td>Nationality</td>
			<td>Passport Number</td>
			<td>Date Expiration</td>
			<th>Place Of Birth</th>
			<th>Date Of Birth</th>
			<th>Seat No</th>
		</tr>
		<tr style="text-align:center; background: #f1f1f1;">
			<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td>
		</tr>
		@foreach($Penumpang as $key => $penumpang)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td>{{ $penumpang->penumpang }}</td>
			<td></td>
			<td>Indonesia</td>
			<td>{{ $penumpang->passport }}</td>
			<td>{{ $penumpang->masa_berlaku }}</td>
			<td>{{ $penumpang->tempat_lahir }}</td>
			<td>{{ $penumpang->tanggal_lahir }}</td>
			<td>{{ $penumpang->nomor_kursi }}</td>
		</tr>
		@endforeach
		@for($i=1; $i<=35-count($Penumpang); $i++)
		<tr>
			<td>{{$i+count($Penumpang)}}</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		@endfor
	</table>
	<div style="page-break-after:always;"></div>
	@else
	<table style="margin-top: 20px; margin-bottom: 10px; width: 100%;">
		<tr>
			<td rowspan="2">No.</td>
			<td rowspan="2">Nama Penumpang</td>
			<td rowspan="2">Handphone</td>
			<td rowspan="2">Tempat Duduk</td>
			<td rowspan="2">TTL</td>
			<td rowspan="2">Keterangan</td>
			<th colspan="2">Tujuan</th>
		</tr>
		<tr>
			<th>Dari</th>
			<th>Ke</th>
		</tr>
		<tr style="text-align:center; background: #f1f1f1;">
			<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td>
		</tr>
		@foreach($Penumpang as $key => $penumpang)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{$penumpang->penumpang}}</td>
			<td>{{$penumpang->telephone}}</td>
			<td>{{$penumpang->nomor_kursi}}</td>
			<td>{{$penumpang->tempat_lahir.' '.$penumpang->tanggal_lahir}}</td>
			<td>{{$penumpang->keterangan}}</td>
			<td>{{$penumpang->jenis_bis_trayek->stasiun_asal}}</td>
			<td>{{$penumpang->jenis_bis_trayek->stasiun_tujuan}}</td>
		</tr>
		@endforeach
		@for($i=1; $i<=35-count($Penumpang); $i++)
		<tr>
			<td>{{$i+count($Penumpang)}}</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		</tr>
		@endfor
		<tr>
			<td>A.</td>
			<td colspan="3">Pendapatan Angkutan ................</td>
			<td>{{ $jmlPnp[$bus] }} Pnp</td>
			<td></td><td></td><td></td>
		</tr>
	</table>
	<div style="page-break-after:always;"></div>
	@endif
	@endforeach

	@if($data_trayek->trayek->id == 7)
		@foreach($pnpBrunei as $bus => $Penumpang1)
			<h3 style="text-align: center;">PERUM UMUM DAMRI</h3>
			<h4 style="text-align: center;">(PERUM DAMRI)</h4>
			<h2 style="text-align: center; text-decoration:underline; margin-top: 10px;">PASSENGER LIST</h2>
			<table class="table-header">
				<tr>
					<td style="width: 30px;">Loket</td>
					<td style="width: 5px;">:</td>
					<td>{{ $data_trayek->trayek->asal }}</td>
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
					<td>@if(isset($formasi[$bus]) && $formasi[$bus]->bis_id != 0) {{ $formasi[$bus]->bis->plat }} @endif</td>
					<td style="width: 30px;">Ke</td>
					<td style="width: 5px;">:</td>
					<td>{{ $data_trayek->trayek->tujuan }}</td>
				</tr>
			</table>
			<table style="margin-top: 20px; margin-bottom: 10px; width: 100%;">
				<tr>
					<td>No.</td>
					<td>Nama Of Passanger</td>
					<td>Sex</td>
					<td>Nationality</td>
					<td>Passport Number</td>
					<td>Date Expiration</td>
					<th>Place Of Birth</th>
					<th>Date Of Birth</th>
					<th>Seat No</th>
				</tr>
				<tr style="text-align:center; background: #f1f1f1;">
					<td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td>
				</tr>
				@foreach($Penumpang1 as $key => $penumpang)
				<tr>
					<td>{{ $key + 1 }}</td>
					<td>{{ $penumpang->penumpang }}</td>
					<td></td>
					<td>Indonesia</td>
					<td>{{ $penumpang->passport }}</td>
					<td>{{ $penumpang->masa_berlaku }}</td>
					<td>{{ $penumpang->tempat_lahir }}</td>
					<td>{{ $penumpang->tanggal_lahir }}</td>
					<td>{{ $penumpang->nomor_kursi }}</td>
				</tr>
				@endforeach
				@for($i=1; $i<=35-count($Penumpang); $i++)
				<tr>
					<td>{{$i+count($Penumpang)}}</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
				</tr>
				@endfor
			</table>
			<div style="page-break-after:always;"></div>
		@endforeach
	@endif