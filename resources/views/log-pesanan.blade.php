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
		"order": [[ 6, "desc" ]]
		processing: true,
        serverSide: true,
        ajax: 'log-pesanan-data',
        columns: [
        	{data: 'petugas', name: 'petugas'},
        	{data: 'aktivitas', name: 'aktivitas'},
        	{data: 'jenis', name: 'jenis'},
        	{data: 'jadwal', name: 'jadwal'},
        	{data: 'stasiun_asal', name: 'stasiun_asal'},
        	{data: 'stasiun_tujuan', name: 'stasiun_tujuan'},
        	{data: 'created_at', name: 'created_at'},
        ]
	})
</script>
@endsection