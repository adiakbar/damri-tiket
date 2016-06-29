@extends('layout.mainLayout')

@section('content')

<div class="cover">
	<div class="icon-loading">
		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
	</div>
</div>

<h2 class="content-title">Data Pesanan</h2>
@if(isset($pesanan))

@endif

	<div class="row">
		<div class="col-md-8">
			<div class="box-content" style="margin-bottom:20px;">
				<form method="GET" action="" class="form-inline">
					<div class="form-group">
				    <label for="">Trayek : </label>
				    <select name="kode_trayek" class="form-control selectpicker" data-live-search="true" required="">
				    	<option> -- Pilih Trayek -- </option>
				    	@foreach($Trayek1 as $trayek)
				    	<option value="{{ $trayek->kode_trayek }}">{{$trayek->stasiun_asal.' - '.$trayek->stasiun_tujuan.' '. substr($trayek->jadwal,0,-3).' ('.$trayek->jenis.')' }}</option>
				    	@endforeach
				    	@foreach($Trayek2 as $trayek)
				    	<option value="{{ $trayek->kode_trayek }}">{{$trayek->alias.' '. substr($trayek->jadwal,0,-3).' ('.$trayek->jenis.')' }}</option>
				    	@endforeach
				    </select>
					</div>

				 	<div class="form-group">
				 		<label for="" style="display:block">Tanggal</label>
				 		<input type="text" name="tanggal" class="form-control" data-provide="datepicker" data-date-format="dd-mm-yyyy" placeholder="Tanggal Berangkat" required="">
				 	</div>

				  
				  <input type="submit" class="btn btn-primary" value="Lihat Pesanan" style="margin-top: 25px;">

				  <!-- <div class="form-group" style="display:block">
				    <div id="input-bis-trayek"></div>
				  </div> -->
				  <input type="hidden" name="_token" value="{{ csrf_token() }}">
				</form>
			</div>
			
		</div>
		@if(isset($pesanan))
		<div class="col-md-4">
			<div class="box-content">
				<p><b>Tanggal</b> : {{ \App\Convert::TanggalIndo($tanggal) }}</p>
				<p style="margin-bottom:0;"><b>{{ $data_trayek->trayek->alias }}</b></p>
				<p style="font-size:12px;">{{ $data_trayek->jenis_bis->jenis.' | '. $data_trayek->jadwal.' WIB' }}</p>
			</div>
		</div>
		@endif
	</div>

<div role="tabpanel">
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#penumpang-booking"  role="tab" data-toggle="tab">Penumpang Booking</a>
		</li>
		<li role="presentation">
			<a href="#penumpang-cash" role="tab" data-toggle="tab">Penumpang Cash</a>
		</li>
	</ul>
	
	@if(isset($pesanan))
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="penumpang-booking">
			<div style="padding:20px;">
				<!-- <h4 style="color: #3498db; display:inline-block">Penumpang dan Tiket</h4> -->
				<form action="{{ url('bayar-tiket') }}" method="POST" style="float:right;">
					<input type="hidden" id="pesanan_booking_id" name="pesanan_id">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="button" value="Bayar dan Cetak Tiket" id="btn_bayar_tiket" class="btn btn-success">
				</form>
				<!-- batal tiket -->
				<form action="{{ url('batal-tiket') }}" method="POST" style="float:right;">
					<input type="hidden" id="pesanan_delete_id" name="pesanan_id">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button class="btn btn-danger btn_batal_tiket" style="margin-right: 20px; margin-bottom:20px;">Batal Tiket</button >
				</form>
				@foreach($pnpBooking as $bus => $Penumpang)
				<h3 class="bus-title" style="border-bottom:none;">{{$bus}}</h3>
				<table class="table" style="font-size:13px;">
					<thead>
						<th style="width: 10px;">No</th>
						<th style="width: 10px;">Kursi</th>
						<th>Nama</th>
						<th>Telepon</th>
						<th>Domisili Asal</th>
						<th>Domisili Tujuan</th>
						<th>Passport</th>
						<th>Masa Berlaku</th>
						<th>Keterangan</th>
						<th>Petugas</th>
						<th></th>
					</thead>
					<tbody>
						@foreach($Penumpang as $key => $penumpang)
						<tr class="tr-click">
							<td>{{ $key + 1 }}</td>
							<td>{{ $penumpang->nomor_kursi }}</td>
							<td>{{ $penumpang->penumpang }}</td>
							<td>{{ $penumpang->telephone }}</td>
							<td>{{ $penumpang->domisili_asal }}</td>
							<td>{{ $penumpang->domisili_tujuan }}</td>
							<td>{{ ($penumpang->passport == '' ? '-' : $penumpang->passport) }}</td>
							<td>{{ ($penumpang->masa_berlaku == '' ? '-' : $penumpang->masa_berlaku) }}</td>
							<td>{{ ($penumpang->keterangan == '' ? '-' : $penumpang->keterangan) }}</td>
							<td>{{ $penumpang->petugas->petugas }}</td>
							<td><input type="checkbox" value="{{ $penumpang->id }}" name="pesanan[]" style="display:none;"></td>
						</tr>
						@endforeach
					</tbody>
				</table>
				@endforeach
			</div>
			
		</div>
		<div role="tabpanel" class="tab-pane" id="penumpang-cash">
			<div style="padding:20px;">
				<!-- batal tiket -->
				<form action="{{ url('batal-tiket') }}" method="POST" style="float:right;">
					<input type="hidden" id="pesanan_delete_id_cash" name="pesanan_id">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button class="btn btn-danger btn_batal_tiket" style="margin-right: 20px; margin-bottom:20px;">Batal Tiket</button >
				</form>
				<a href="{{ url('pesanan-export?tanggal='.$tanggal.'&kode_trayek='.$data_trayek->kode_trayek) }}" class="btn btn-success pull-right" style="margin-right: 20px;" target="_blank"> Cetak AP/3</a>
				@foreach($pnpCash as $bus => $Penumpang)
				<h3 class="bus-title" style="border-bottom:none;">{{$bus}}</h3>
				<table class="table table-bordered" style="font-size:13px;">
					<thead>
						<tr>
							<th style="width: 10px;" rowspan="2">No</th>
							<th style="width: 10px;" rowspan="2">No. Tiket</th>
							<th rowspan="2">Nama Penumpang</th>
							<th rowspan="2">No. Telepon</th>
							<th colspan="2">Tujuan</th>
							<th rowspan="2">Kursi</th>
							<th colspan="3">Pendapatan Angkutan</th>
							<th rowspan="2" style="width: 10px;">Biaya Operasional / Transit</th>
							<th rowspan="2">Keterangan</th>
							<th rowspan="2">Petugas</th>
						</tr>
						<tr>
							<th>Dari</th>
							<th>Ke</th>
							<th>Bagasi</th>
							<th>Penumpang</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						@foreach($Penumpang as $key => $penumpang)
						<tr class="tr-click">
							<td>{{ $key + 1 }}</td>
							<td>{{ $penumpang->numeratur }}</td>
							<td>{{ $penumpang->penumpang }}</td>
							<td>{{ $penumpang->telephone }}</td>
							<td>{{ $penumpang->jenis_bis_trayek->stasiun_asal }}</td>
							<td>{{ $penumpang->jenis_bis_trayek->stasiun_tujuan }}</td>
							<td>{{ $penumpang->nomor_kursi }}</td>
							<td>-</td>
							<td>{{ "Rp ".number_format($penumpang->jenis_bis_trayek->harga,0,',','.') }}</td>
							<td>-</td>
							<td>-</td>
							<td>{{ ($penumpang->keterangan == '' ? '-' : $penumpang->keterangan) }}</td>
							<td>{{ $penumpang->petugas->petugas }}</td>
							<td><input type="checkbox" value="{{ $penumpang->id }}" name="pesanan[]" style="display:none;"></td>
						</tr>
						@endforeach
						<tr>
							<td colspan="8">Jumlah</td>
							<td colspan="5">{{ "Rp ".number_format($jmlHarga[$bus],0,',','.') }}</td>
						</tr>
					</tbody>
				</table>
				@endforeach
			</div>
		</div>
	</div>

	@endif
</div>


@endsection

@section('script')

<script type="text/javascript">
	$(document).ready(function(){

	

		$('.table-pesanan').DataTable({"iDisplayLength": 100});

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
				$(this).addClass('highlight');
			}

			$('#pesanan_booking_id').val(tiket.join());
			$('#pesanan_delete_id').val(tiket.join());
			$('#pesanan_delete_id_cash').val(tiket.join());
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

		$('.btn_batal_tiket').click(function() {
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