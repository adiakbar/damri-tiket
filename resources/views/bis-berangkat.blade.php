@extends('layout.mainLayout')

@section('content')

<h2 class="content-title">Manajemen Bis</h2>

<a href="{{ url('bis-berangkat') }}" style="font-size:12px;">Bis Berangkat</a> |
@if(Auth::user()->level == 'admin' || Auth::user()->level == 'superadmin' || Auth::user()->level == 'root')
<a href="{{ url('bis-default') }}" style="font-size:12px;">Bis Default</a> |
<a href="{{ url('bis') }}" style="font-size:12px;">Bis</a>
@endif

@if(Auth::user()->level == 'admin' || Auth::user()->level == 'superadmin' || Auth::user()->level == 'root')
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-4">
				<div class="box-content">
					<h4 style="color: #3498db;">Set Bis Berangkat</h4>
					<form method="POST" action="" class="form-inline">
						@if(session('warning'))
							<div class="alert alert-danger" style="padding: 5px;">
						        {{ session('warning') }}
						    </div>
						@endif
					 	<div class="form-group">
					 		<label for="" style="display:block">Tanggal</label>
					 		<input type="text" name="tanggal" class="form-control" data-provide="datepicker" data-date-format="dd-mm-yyyy" placeholder="Tanggal Berangkat" required="">
					 	</div>

					  <input type="hidden" name="_token" value="{{ csrf_token() }}">
					  <input type="submit" class="btn btn-primary" value="Atur Bis" style="margin-top: 25px;">
					</form>
				</div>
			</div>
			<div class="col-md-8">
				<div class="box-content">
					<h4 style="color: #3498db;">Set Bis Tambahan</h4>
					<form action="{{ url('bis-tambahan') }}" method="POST" class="form-inline">
					<div class="form-group">
              <label for="">Trayek : </label>
              <select id="trayek" class="form-control selectpicker" data-live-search="true" required="">
                  <option> -- Pilih Trayek -- </option>
              </select>
          </div>
                  
              
          <div class="form-group">
            <label for="">Nomor Bis</label>
            <select name="nomor_bis" id="" class="form-control selectpicker" data-live-search="true" required="">
               <option value="Bis 5">Bis 5</option>
               <option value="Bis 6">Bis 6</option>
               <option value="Bis 7">Bis 7</option>
               <option value="Bis 8">Bis 8</option>
               <option value="Bis 8">Bis 11</option>
               <option value="Bis 8">Bis 12</option>
               <option value="Bis 8">Bis 13</option>
               <option value="Bis 8">Bis 14</option>
               <option value="Bis Tambahan 1">Bis Tambahan 1</option>
               <option value="Bis Tambahan 2">Bis Tambahan 2</option>
               <option value="Bis Tambahan 3">Bis Tambahan 3</option>
               <option value="Bis Tambahan 4">Bis Tambahan 4</option>
            </select>
          </div>
					
					<div class="form-group">
				 		<label for="" style="display:block">Tanggal</label>
				 		<input type="text" name="tanggal" class="form-control" data-provide="datepicker" data-date-format="dd-mm-yyyy" placeholder="Tanggal Berangkat" required="">
				 	</div>

				 	<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="submit" class="btn btn-primary" value="Atur Bis" style="margin-top: 25px;">

					<div class="form-group" style="display:block">
            <div id="input-bis-trayek"></div>
          </div>

				</form>
				</div>
				
			</div>
		</div>
		
	</div>
</div>
@endif

<div class="row">
	<div class="col-md-12">
		<div class="box-content">
			<h4 style="color: #3498db;">Bis Berangkat</h4>

			<table class="table table-striped" id="table-bis" style="font-size:13px;">
				<thead>
					<th>No.</th>
					<th>Tanggal</th>
					<th>Trayek</th>
					<th>Jenis Bis</th>
					<th>Jadwal</th>
					<th>Nomor Bis</th>
					<th>Plat Bis</th>
					<th>Jumlah Kursi</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($bis_berangkat as $key => $value)
					<tr>
						<td>{{ $key + 1 }}</td>
						<td>{{ \App\Convert::TanggalIndo($value->tanggal) }}</td>
						<td>{{ $value->alias  }}</td>
						<td>{{ ucwords(str_replace("-", " ", $value->slug_jenis_bis)) }}</td>
						<td>{{ substr($value->jadwal,0,-3) }} WIB</td>
						<td>{{ $value->nomor_bis }}</td>
						@if($value->bis_id == 0)
						<td> - </td>
						<td> - </td>
						@else
						<td>{{ $value->bis->plat }}</td>
						<td>{{ $value->bis->jumlah_kursi }}</td>
						@endif
						<td>
							<button class="btn btn-xs btn-warning btn-modal" data-toggle="modal" data-target="#myModal" data-tanggal="{{ App\Convert::tgl_eng_to_ind($value->tanggal) }}" data-nomor-bis="{{ $value->nomor_bis }}" data-jadwal="{{ substr($value->jadwal,0,-3).' WIB' }}" data-jenis-bis="{{ ucwords(str_replace("-", " ", $value->slug_jenis_bis)) }}" data-trayek="{{ $value->alias }}" data-kode-trayek="{{ $value->kode_trayek }}">Edit</button>
							<button class="btn btn-xs btn-danger btn-hapus-bis" data-tanggal="{{ App\Convert::tgl_eng_to_ind($value->tanggal) }}" data-nomor-bis="{{ $value->nomor_bis }}" data-kode-trayek="{{ $value->kode_trayek }}">hapus</button>
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
				<h4 class="modal-title">Edit Bis Berangkat</h4>
			</div>
			<div class="modal-body">
				<form action="{{ url('bis-berangkat/update') }}" method="POST">
					<div id="modal_trayek"></div>
					
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
						 		<label for="" style="display:block">Tanggal</label>
						 		<input type="text" id="modal_tanggal" class="form-control" disabled>
						 	</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
						  	<label for="">Nomor Bis</label>
						  	<input type="text" id="modal_nomor_bis" class="form-control" disabled>
						  </div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
						  	<label for="">Plat Bis</label>
                <select name="bis_id" id="" class="form-control selectpicker" data-live-search="true">
                    @foreach($bis as $value)
                    <option value="{{ $value->id }}">{{ $value->plat.' ('.$value->jenis_bis->jenis.' - '.$value->jumlah_kursi.')' }}</option>
                    @endforeach
                </select>
						  </div>
						</div>
					</div>
					<input type="hidden" name="kode_trayek" id="modal_kode_trayek_input">
					<input type="hidden" name="nomor_bis" id="modal_nomor_bis_input">
					<input type="hidden" name="tanggal" id="modal_tanggal_input">
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
            $("#input-bis-trayek").append("<div class='checkbox'><label><input type='checkbox' name='bis_trayek[]' value="+value.id+"><b>"+value.jenis_bis.jenis+" - "+value.jadwal+" WIB</b><p style='font-size:12px;'>"+value.stasiun_asal+" - "+value.stasiun_tujuan+"</p></label></div>");

            console.log(value);
        });
    });

		$('#table-bis').DataTable({"iDisplayLength": 100});

		$('.btn-modal').click(function() {
			var jenis_bis = $(this).attr('data-jenis-bis');
			var jadwal = $(this).attr('data-jadwal');
			var trayek = $(this).attr('data-trayek');
			var kode_trayek = $(this).attr('data-kode-trayek');
			var nomor_bis = $(this).attr('data-nomor-bis');
			var plat_bis = $(this).attr('data-plat-bis');
			var tanggal = $(this).attr('data-tanggal');

			$('#modal_trayek').html("<b>"+jenis_bis+" | "+jadwal+"</b><p style='font-size:12px'>"+trayek+"</p>");
			$('#modal_plat_bis').val(plat_bis);
			$('#modal_tanggal').val(tanggal);
			$('#modal_nomor_bis').val(nomor_bis);
			
			$('#modal_nomor_bis_input').val(nomor_bis);
			$('#modal_kode_trayek_input').val(kode_trayek);
			$('#modal_tanggal_input').val(tanggal);
		});

		$('.btn-hapus-bis').click(function() {
			var kode_trayek = $(this).attr('data-kode-trayek');
			var nomor_bis = $(this).attr('data-nomor-bis');
			var tanggal = $(this).attr('data-tanggal');

			var c = confirm("Apakah anda yakin ingin menghapus bis berangkat?");
			if(c == true)
			{
				window.location = base_url+'/bis-berangkat/delete?kode_trayek='+kode_trayek+'&nomor_bis='+nomor_bis+'&tanggal='+tanggal;
				return true;
			}
			return false;
		});

	});

</script>

@endsection