@extends('layout.mainLayout')

@section('content')

<h2 class="content-title">Pesan Tiket</h2>

<div class="row">

	<!-- col-md-4 -->
	<div class="col-md-4">
		<!-- box-form-filter-keberangkatan -->
		<div class="box-content">
			<form>
				<div class="form-group">
			    <label for="">Tanggal : </label>
			    <input type="text" name="tanggal" class="form-control" data-provide="datepicker" data-date-format="dd-mm-yyyy" placeholder="Tanggal Berangkat">
			  </div>
				<div class="form-group">
			    <label for="">Trayek : </label>
			    <select id="trayek" class="form-control selectpicker" data-live-search="true">
			    	<option> -- Pilih Trayek -- </option>
			    </select>
			  </div>
			  <div class="form-group">
			    <div id="input-bis-trayek"></div>
			  </div>
			  
			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
			  <input type="submit" class="btn btn-primary" value="Pesan Tiket">
			</form>
		</div>
		<!-- end-box-content -->
	</div>
	<!-- end-col-md-4 -->

	<!-- col-md-8 -->
	<div class="col-md-8">

		<div class="box-content">

			@if(isset($bis))
				
				<div class="row">
					
					<div class="col-md-4">
							<div class="slider-bis">
								@foreach($bis as $key => $value)
									<?php 
										$jenis = $value->jenis_bis_trayek->jenis_bis->slug_jenis;
										$jumlah_kursi = $value->jumlah_kursi;
										if($jumlah_kursi == '')
										{
											$jumlah_kursi = $value->bis->jumlah_kursi;
										}
									?>
									@include('layout.kursi-'.$jenis.'-'.$jumlah_kursi)
								@endforeach
							</div>
							<div class="navBis">
								<a id="prev2" href="#">Prev</a>
								<a id="next2" href="#">Next</a>
							</div> 
					</div>
					
					<div class="col-md-6">
						<form style="margin-top: 15px;" action="pesan-tiket" method="POST">
							<div class="form-group">
						    <label for="">Nomor Kursi : </label>
						    <input type="text" class="form-control" disabled id="nomor-kursi-disable">
						  </div>
							<div class="form-group">
						    <label for="">Nama : </label>
						    <input type="text" name="penumpang" class="form-control" placeholder="Nama">
						  </div>
						  <div class="form-group">
						    <label for="">Telephone : </label>
						    <input type="text" name="telephone" class="form-control" placeholder="Telephone">
						  </div>
						  <div class="form-group">
						    <label for="">Passport : </label>
						    <input type="text" name="passport" class="form-control" placeholder="Passport">
						  </div>
						  <div class="form-group">
						    <label for="">Keterangan : </label>
						    <textarea name="keterangan" class="form-control"></textarea>
						  </div>
						  <div class="radio" style="margin-bottom:20px;">
						  	<label style="margin-right:20px;">
						  		<input type="radio" name="status" value="cash" checked=""> Cash
						  	</label>
						  	<label>
						  		<input type="radio" name="status" value="booking"> Booking
						  	</label>
						  </div>
						  <input type="hidden" name="nomor_kursi" id="nomor-kursi">
						  <input type="hidden" name="kode_trayek">
						  <input type="hidden" name="nomor_bis">
						  <input type="hidden" name="bis_id">
						  <input type="hidden" name="tanggal" value="{{ $tanggal }}">
						  <input type="hidden" name="jenis_bis_trayek_id" value="{{ $jenis_bis_trayek_id }}">
						  <input type="hidden" name="petugas_id" value="1">
						  <input type="hidden" name="_token" value="{{ csrf_token() }}">

						  <input type="submit" class="btn btn-warning" value="Pesan Tiket">
						</form>
					</div>
					<!-- end col-md-6 -->
				</div>
				<!-- end row -->
			@else
				<h4>Tentukan Trayek dan Bis Terlebih Dahulu</h4>
			@endif

		</div>
		<!-- end box content -->
	</div>
	<!-- end-col-md-8 -->

</div>

@stop

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
				$("#input-bis-trayek").append("<div class='radio'><label><input type='radio' name='bis_trayek' value="+value.id+"><b>"+value.jenis_bis.jenis+" - "+value.jadwal.slice(0,-3)+" WIB</b><p style='font-size:12px;'>"+value.stasiun_asal+" - "+value.stasiun_tujuan+"</p></label></div>");
				console.log(value);
			});
		});

		var kursi;
		$('.kursi').click(function() {
			if($(this).hasClass('booking')==false && $(this).hasClass('cash')==false)
			{
				$(this).children('input').trigger('click');
				kursi = $('input:checkbox:checked.cek-kursi').map(function(){
					return $(this).val();
				}).get();
				// console.log(kursi.join());

				$('#nomor-kursi-disable, #nomor-kursi').val(kursi.join());

				var kode_trayek = $(this).parent().parent('.container-kursi').attr('data-kode-trayek');
				var nomor_bis = $(this).parent().parent('.container-kursi').attr('data-nomor-bis');
				var bis_id = $(this).parent().parent('.container-kursi').attr('data-bis-id');
				
				$("input[name='kode_trayek']").val(kode_trayek);
				$("input[name='nomor_bis']").val(nomor_bis);
				$("input[name='bis_id']").val(bis_id); 

				
				if($(this).children('input').prop('checked') == false) 
				{
					$(this).removeClass('highlight');
				}
				else
				{
					$(this).addClass('highlight');
				}
			}
		});

		$('.slider-bis').cycle({ 
			    fx: 'scrollLeft',
			    speed: 300, 
			    timeout: 0, 
			    next: '#next2', 
			    prev: '#prev2' 
			});

	});
</script>

@endsection