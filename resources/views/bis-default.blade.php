@extends('layout.mainLayout')

@section('content')

<h2 class="content-title">Manajemen Bis</h2>
<a href="{{ url('bis-default') }}">Bis Default</a> |
<a href="{{ url('bis-berangkat') }}">Bis Berangkat</a> |
<a href="{{ url('bis') }}">Bis</a>

<div class="row">
	
	<div class="col-md-12">
		<div class="box-content">
			<h4 style="color: #3498db;">Tambah Bis Default</h4>
			<form method="POST" action="" class="form-inline">
				@if(session('warning'))
					<div class="alert alert-danger" style="padding: 5px;">
				        {{ session('warning') }}
				    </div>
				@endif
				<div class="form-group">
			    <label for="">Trayek : </label>
			    <select id="trayek" class="form-control selectpicker" data-live-search="true">
			    	<option> -- Pilih Trayek -- </option>
			    </select>
			  </div>
			  
			  
			  <div class="form-group">
			  	<label for="">Nomor Bis</label>
			  	<select name="nomor_bis" id="" class="form-control selectpicker" data-live-search="true">
			  		<option value="Bis Default">Tidak Pake Nomor Bis</option>
			  		<option value="Bis 1">Bis 1</option>
			  		<option value="Bis 2">Bis 2</option>
			  		<option value="Bis 3">Bis 3</option>
			  		<option value="Bis 4">Bis 4</option>
			  		<option value="Bis 9">Bis 9</option>
			  		<option value="Bis 10">Bis 10</option>
			  	</select>
			  </div>

			  <div class="form-group">
			  	<label for="">Jumlah Kursi</label>
			  	<select name="jumlah_kursi" id="" class="form-control selectpicker">
			  		<option value="23">23</option>
			  		<option value="25">25</option>
			  		<option value="26">26</option>
			  		<option value="31">31</option>
			  		<option value="33">33</option>
			  		<option value="34">34</option>
			  	</select>
			  </div>

			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
			  <input type="submit" class="btn btn-primary" value="Atur Bis" style="margin-top:25px;">
				
				<div>
					<div class="form-group">
				    <div id="input-bis-trayek"></div>
				  </div>
				</div>
			</form>
		</div>
	</div>

</div>

<div class="row">

	<div class="col-md-12">
		<div class="box-content">
			<h4 style="color: #3498db;">Bis Default</h4>

			<table class="table" id="table-bis">
				<thead>
					<th>No.</th>
					<th>Trayek</th>
					<th>Jenis Bis</th>
					<th>Jadwal</th>
					<th>Stasiun Asal</th>
					<th>Stasiun Tujuan</th>
					<th style="width: 20px;">Nomor Bis</th>
					<th style="width: 20px;">Jumlah Kursi</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($bis_default as $key => $value)
					<tr>
						<td>{{ $key + 1 }}</td>
						<td>{{ $value->jenis_bis_trayek->trayek->alias }}</td>
						<td>{{ $value->jenis_bis_trayek->jenis_bis->jenis }}</td>
						<td>{{ $value->jenis_bis_trayek->jadwal.' WIB' }}</td>
						<td>{{ $value->jenis_bis_trayek->stasiun_asal }}</td>
						<td>{{ $value->jenis_bis_trayek->stasiun_tujuan }}</td>
						<td>{{ $value->nomor_bis }}</td>
						<td>{{ $value->jumlah_kursi }}</td>
						<td>
							<button class="btn btn-xs btn-warning btn-modal" data-toggle="modal" data-target="#myModal" data-jumlah-kursi="{{ $value->jumlah_kursi }}" data-jenis-bis="{{ $value->jenis_bis_trayek->jenis_bis->jenis }}" data-jadwal="{{ $value->jenis_bis_trayek->jadwal.' WIB' }}" data-stasiun-asal="{{ $value->jenis_bis_trayek->stasiun_asal }}" data-stasiun-tujuan="{{ $value->jenis_bis_trayek->stasiun_tujuan }}" data-nomor-bis="{{ $value->nomor_bis }}" data-id="{{ $value->id }}">Edit</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

</div>

<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Bis Default</h4>
			</div>
			<div class="modal-body">
				<form action="{{ url('bis-default-update') }}" method="POST">
					<div id="modal_trayek"></div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
						  	<label for="">Nomor Bis</label>
						  	<select name="nomor_bis" id="modal_nomor_bis" class="form-control">
						  		@for($i = 1; $i<=16; $i++)
						  		<option value="Bis {{ $i }}">Bis {{ $i }}</option>
						  		@endfor
						  	</select>
						  </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
						  	<label for="">Jumlah Kursi</label>
						  	<select name="jumlah_kursi" id="modal_jumlah_kursi" class="form-control">
						  		<option value="23">23</option>
						  		<option value="25">25</option>
						  		<option value="26">26</option>
						  		<option value="31">31</option>
						  		<option value="33">33</option>
						  		<option value="34">34</option>
						  	</select>
						  </div>
						</div>
					</div>
					<input type="hidden" name="id" id="modal_id">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="submit" value="Update" class="btn btn-primary">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>


@endsection

@section('script')

<script type="text/javascript">
		
	$(document).ready(function() {

		var trayek = <?php echo($trayek); ?>

		$.each(trayek, function(index, value) {
			$("#trayek").append("<option value="+value.id+">"+value.alias+"</option>");
		});

		$("#trayek").change(function() {
			var id = $(this).val();
			$("#input-bis-trayek").empty();
			
			$.each(trayek[id-1].jenis_bis_trayek, function(index, value) {
				$("#input-bis-trayek").append("<div class='radio'><label><input type='radio' name='bis_trayek' value="+value.id+"><b>"+value.jenis_bis.jenis+" - "+value.jadwal+" WIB</b><p style='font-size:12px;'>"+value.stasiun_asal+" - "+value.stasiun_tujuan+"</p></label></div>");

				console.log(value);
			});
		});


		$('#table-bis').DataTable({"iDisplayLength": 100});

		$('.btn-modal').click(function() {
			var jumlah_kursi = $(this).attr('data-jumlah-kursi');
			var jenis_bis = $(this).attr('data-jenis-bis');
			var jadwal = $(this).attr('data-jadwal');
			var stasiun_asal = $(this).attr('data-stasiun-asal');
			var stasiun_tujuan = $(this).attr('data-stasiun-tujuan');
			var nomor_bis = $(this).attr('data-nomor-bis');
			var id = $(this).attr('data-id');

			$('#modal_nomor_bis').val(nomor_bis);
			$('#modal_trayek').html("<b>"+jenis_bis+" | "+jadwal+"</b><p style='font-size:12px'>"+stasiun_asal+" - "+stasiun_tujuan+"</p>");
			$('#modal_jumlah_kursi').val(jumlah_kursi);
			$('#modal_id').val(id);
		});

	})
		

</script>

@endsection