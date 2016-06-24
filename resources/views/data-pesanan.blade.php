@extends('layout.mainLayout')

@section('content')

<div class="cover">
	<div class="icon-loading">
		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
	</div>
</div>

<h2 class="content-title">Data Pesanan</h2>

<a href="{{ url('pesanan-export') }}" style="font-size:12px;"> Export Data Pesanan</a>

		<div class="box-content">
			<div class="row">
				<div class="col-md-8">
					<form method="GET" action="" class="form-inline">
						<div class="form-group">
						    <label for="">Trayek : </label>
						    <select name="trayek_id" class="form-control selectpicker" data-live-search="true">
						    	<option> -- Pilih Trayek -- </option>
						    	@foreach($Trayek as $value)
						    	<option value="{{ $value->id }}">{{ $value->alias }}</option>
						    	@endforeach
						    </select>
						</div>

					 	<div class="form-group">
					 		<label for="" style="display:block">Tanggal</label>
					 		<input type="text" name="tanggal" class="form-control" data-provide="datepicker" data-date-format="dd-mm-yyyy" placeholder="Tanggal Berangkat">
					 	</div>

					  <input type="hidden" name="_token" value="{{ csrf_token() }}">
					  <input type="submit" class="btn btn-primary" value="Lihat Pesanan" style="margin-top: 25px;">

					  <div class="form-group" style="display:block">
					    <div id="input-bis-trayek"></div>
					  </div>
					</form>
				</div>
				@if(isset($pesanan))
				<div class="col-md-4">
					<h4 style="color: #3498db;">Trayek</h4>
					<p style="margin-bottom:0;"><b>Tanggal</b> : {{ \App\Convert::TanggalIndo($tanggal)   }}</p>
					<p><b>Trayek</b> : {{ $trayek->alias }}</p>
				</div>
				@endif
			</div>
			
		</div>

<div class="row">
	<!-- col-md-12 -->
	<div class="col-md-12">
		
		<div class="box-content">
			<h4 style="color: #3498db; display:inline-block">Penumpang dan Tiket</h4>
			<form action="{{ url('bayar-tiket') }}" method="POST" style="float:right;">
				<input type="hidden" id="pesanan_booking_id" name="pesanan_id">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="button" value="Bayar dan Cetak Tiket" id="btn_bayar_tiket" class="btn btn-success">
			</form>
			<form action="{{ url('batal-tiket') }}" method="POST" style="float:right;">
				<input type="hidden" id="pesanan_delete_id" name="pesanan_id">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				
				<button class="btn btn-danger" id="btn_batal_tiket" style="margin-right: 20px; margin-bottom:20px;">Batal Tiket</button >
			</form>
			<table class="table" id="table-pesanan" style="font-size:13px;">
				<thead>
					<th style="width: 10px;">No</th>
					<th>Nomor Bis</th>
					<th>Jenis Bis</th>
					<th>Stasiun Tujuan</th>
					<th>Jadwal</th>
					<th style="width: 10px;">Kursi</th>
					<th>Nama</th>
					<th>Telepon</th>
					<th>Status</th>
					<th>Kode Tiket</th>
					<th>Keterangan</th>
					<th>Petugas</th>
					<th></th>
				</thead>
				@if(isset($pesanan))
				<tbody>
					@foreach($pesanan as $key => $value)
					<tr class="tr-click @if($value->status == 'booking') booking @endif">
						<td>{{ $key + 1 }}</td>
						<td>{{ $value->nomor_bis }}</td>
						<td>{{ $value->jenis_bis_trayek->jenis_bis->jenis }}</td>
						<td>{{ $value->jenis_bis_trayek->stasiun_tujuan }}</td>
						<td>{{ $value->jenis_bis_trayek->jadwal }}</td>
						<td>{{ $value->nomor_kursi }}</td>
						<td>{{ $value->penumpang }}</td>
						<td>{{ $value->telephone }}</td>
						<td id="{{ 'status-tiket-'.$value->id }}">{{ $value->status }}</td>
						<td id="{{ 'kode-tiket-'.$value->id }}">{{ $value->numeratur}}</td>
						<td>{{ $value->keterangan }}</td>
						<td>{{ $value->petugas->petugas }}</td>
						<td>
							<input type="checkbox" value="{{ $value->id }}" name="pesanan[]" style="display:none;">
						</td>
					</tr>
					@endforeach
				</tbody>
				@endif
			</table>
		</div>

	</div>

</div>

@endsection

@section('script')

<script type="text/javascript">
	$(document).ready(function(){

		$('#table-pesanan').DataTable({"iDisplayLength": 100});

		$(".tr-click").click(function() {
			$(this).children().children("input").trigger('click');

			tiket = $('input:checkbox:checked').map(function(){
				return $(this).val();
			}).get();

			if($(this).children().children('input').prop('checked') == false) 
			{
				$(this).removeClass('highlight');
			}
			else
			{
				$(this).removeClass('booking');
				$(this).addClass('highlight');
			}

			$('#pesanan_booking_id').val(tiket.join());
			$('#pesanan_delete_id').val(tiket.join());
			
		});

		$('#btn_bayar_tiket').click(function() {
			var pesanan_id = $('#pesanan_booking_id').val();
			var token = $("input[name='_token']").val();
			if(pesanan_id == '')
			{
				alert("Plih Tiket yang akan di bayar");
				return false;
			}
			else
			{
				$('.cover').show();
				$.ajax({
					type: "POST",
					url: "bayar-tiket",
					data: "pesanan_id="+pesanan_id+"&_token="+token,
					success: function(data) {
						// console.log(data);
						$.each(data, function(key,value) {
							$("#kode-tiket-"+value.id).html(value.numeratur);
							$("#status-tiket-"+value.id).html(value.status);
							$('.cover').hide();
						});

						$('.tr-click').removeClass('highlight');
						$('#pesanan_booking_id').val("");
						$('#pesanan_delete_id').val("");
						// ubah jadi uncheck
						$("input[type='checkbox']").prop('checked', false);
						window.open('cetak-tiket?pesanan_id='+pesanan_id,'print','location=0');
					}
				});
			}
		});

		$('#btn_batal_tiket').click(function() {
			var c = confirm("Apakah Anda yakin akan membatalkan tiket ini?");
			if(c == true)
			{
				$(this).parent().submit();
			}
			return false;
		})
	});

</script>

@endsection