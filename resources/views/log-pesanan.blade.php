@extends('layout.mainLayout')

@section('content')

<h2 class="content-title">Log Tiket</h2>

<div class="box-content">
	<table class="table table-hover" id="table-log" style="font-size:12px;">
		<thead>
			<tr>
				<th>Petugas</th>
				<th>Aktivitas</th>
				<th>Jenis Bis</th>
				<th>Jadwal</th>
				<th>Stasiun Asal</th>
				<th>Stasiun Tujuan</th>
				<th>Timestamp</th>
			</tr>
		</thead>
	</table>
</div>

@endsection

@section('script')
<script type="text/javascript">
	// $('#table-log').DataTable({"iDisplayLength": 100});
	$('#table-log').DataTable({
		"iDisplayLength": 100,
		processing: true,
        serverSide: true,
        ajax: 'log-pesanan-data',
        columns: [
        	{data: 'petugas', name: 'petugas'},
        	{data: 'aktivitas', name: 'petugas'},
        	{data: 'jenis_bis_trayek.jenis_bis.jenis', name: 'jenis_bis'},
        	{data: 'jenis_bis_trayek.jadwal', name: 'jenis_bis'},
        	{data: 'jenis_bis_trayek.stasiun_asal', name: 'stasiun_asal'},
        	{data: 'jenis_bis_trayek.stasiun_tujuan', name: 'stasiun_tujuan'},
        	{data: 'created_at', name: 'dsf'},
        ]
	})
</script>
@endsection