@extends('layout.mainLayout')

@section('content')

<h2 class="content-title">Pesan Tiket</h2>

<div class="row">

	<!-- col-md-4 -->
	<div class="col-md-3" >
		<!-- box-form-filter-keberangkatan -->
		<div class="box-content" @if(isset($Bis)) style="display:none;" @endif>
			<form>
				<div class="form-group">
			    <label for="">Tanggal : </label>
			    <input type="text" name="tanggal" class="form-control" data-provide="datepicker" data-date-format="dd-mm-yyyy" placeholder="Tanggal Berangkat" required="">
			  </div>
				<div class="form-group">
			    <label for="">Trayek : </label>
			    <select id="trayek" class="form-control selectpicker" data-live-search="true" required="">
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
		
		@if(isset($data_trayek))
		<div class="box-content">
			<h4 style="color: #3498db;">Trayek</h4>
			<p><b>Tanggal</b> : {{ \App\Convert::TanggalIndo($tanggal) }}</p>
			<p><b>Harga</b> : {{ "Rp ".number_format($data_trayek->harga,0,',','.') }}</p>
			<p style="margin-bottom:0;"><b>{{ $data_trayek->jenis_bis->jenis.' | '. $data_trayek->jadwal.' WIB' }}</b></p>
			<p style="font-size:12px;">{{ $data_trayek->stasiun_asal.' - '.$data_trayek->stasiun_tujuan }}</p>
			<p><b>Jumlah Bis Berangkat</b> : <span style="font-size: 25px;">{{ count($Bis).' Bis' }}</span></p>
		</div>
		@endif
	</div>
	<!-- end-col-md-4 -->

	<!-- col-md-8 -->
	<div class="col-md-9">

		<div class="box-content">

			@if(isset($Bis))
				
				<div class="row">
					
					<div class="col-md-5">
						<div class="slider-bis">
							@foreach($Bis as $bis)
	              @if($bis->bis_id == 0)
	              	<?php
	                  $jenis = $bis->slug_jenis_bis;
	                  $jumlah_kursi = $bis->jumlah_kursi;
	                ?>
	              @else
	              	<?php
	                  $jenis = $bis->bis->jenis_bis->slug_jenis;
	                  $jumlah_kursi = $bis->bis->jumlah_kursi;
	                ?>
	              @endif
	              
	             	@include('layout.kursi-'.$jenis.'-'.$jumlah_kursi)
	            @endforeach

	           </div>
	           @if(count($Bis) > 1)
              	<div class="navBis" style="text-align: center;">
                  <a id="prev2" href="#">Prev</a>
                  <a id="next2" href="#">Next</a>
                </div> 
              @endif
					</div>
					
					<div class="col-md-7">
						<form style="margin-top: 15px;" action="{{ url('pesan-tiket') }}" method="POST" id="form-pesan-tiket">
							@if(session('warning'))
								<div class="alert alert-danger" style="padding: 5px;">
							        {{ session('warning') }}
							    </div>
							@endif
							
							<div class="form-group">
						    <label for="">Nomor Kursi : <span class="span-required">*wajib di isi</span></label>
						    <input type="text" class="form-control" disabled id="nomor-kursi-disable">
						  </div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
								    <label for="">Nama : <span class="span-required">*wajib di isi</span></label>
								    <input type="text" name="penumpang" class="form-control" placeholder="Nama" value="{{ Request::old('penumpang') }}">
								  </div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
								    <label for="">Nomor Telepon : <span class="span-required">*wajib di isi</span></label>
								    <input type="text" name="telephone" class="form-control" placeholder="Telephone" value="{{ Request::old('telephone') }}">
								  </div>
								</div>
							</div>
						  <div class="row">
						  	<div class="col-md-6">
						  		<div class="form-group">
								    <label for="">Domisili Asal : <span class="span-required">*wajib di isi</span></label>
								    <input type="text" name="domisili_asal" class="form-control" placeholder="Domisi Asal" value="{{ Request::old('domisili_asal') }}">
								  </div>
						  	</div>
						  	<div class="col-md-6">
						  		<div class="form-group">
								    <label for="">Domisili Tujuan : <span class="span-required">*wajib di isi</span></label>
								    <input type="text" name="domisili_tujuan" class="form-control" placeholder="Domisi Tujuan" value="{{ Request::old('domisili_tujuan') }}">
								  </div>
						  	</div>
						  </div>
						  <div class="row">
						  	<div class="col-md-6">
						  		<div class="form-group">
								    <label for="">Passport : </label>
								    <input type="text" name="passport" class="form-control" placeholder="Passport" value="{{ Request::old('passport') }}">
								  </div>
						  	</div>
						  	<div class="col-md-6">
						  		<div class="form-group">
								    <label for="">Masa Berlaku : </label>
								    <input type="text" name="masa_berlaku" class="form-control" placeholder="Masa Berlaku" value="{{ Request::old('masa_berlaku') }}">
								  </div>
						  	</div>
						  </div>
						  <div class="row">
						  	<div class="col-md-6">
						  		<div class="form-group">
								    <label for="">Tempat Lahir </label>
								    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ Request::old('tempat_lahir') }}">
								  </div>
						  	</div>
						  	<div class="col-md-6">
						  		<div class="form-group">
								    <label for="">Tanggal Lahir </label>
								    <input type="text" name="tanggal_lahir" class="form-control" data-provide="datepicker" data-date-format="dd MM yyyy" placeholder="Tanggal Lahir" value="{{ Request::old('tanggal_lahir') }}">
								  </div>
						  	</div>
						  </div>
						  <div class="form-group">
						    <label for="">Keterangan : </label>
						    <textarea name="keterangan" class="form-control">{{ Request::old('keterangan') }}</textarea>
						  </div>
						  <input type="hidden" name="nomor_kursi" id="nomor-kursi">
						  <input type="hidden" name="kode_trayek">
						  <input type="hidden" name="nomor_bis">
						  <input type="hidden" name="bis_id">
						  <input type="hidden" name="tanggal" value="{{ $tanggal }}">
						  <input type="hidden" name="jenis_bis_trayek_id" value="{{ $jenis_bis_trayek_id }}">
						  <input type="hidden" name="petugas_id" value="{{ Auth::user()->id }}">
						  <input type="hidden" name="trayek_id" value="{{ $data_trayek->trayek_id }}">
						  <input type="hidden" name="status" value="booking">
						  <input type="hidden" name="_token" value="{{ csrf_token() }}">
							<p class="text-error"></p>
							<button class="btn btn-warning" id="btn-pesan-tiket">Pesan Tiket</button>
						</form>
					</div>
					<!-- end col-md-6 -->
				</div>
				<!-- end row -->
			@else
				<h4 style="color: #3498db;">Tentukan Trayek dan Bis Terlebih Dahulu</h4>
				<p>Penjualan Tiket Hari ini</p>
				<div class="row">
					@foreach($jml_tiket as $key => $value)
					<div class="col-md-2">
						<div class="box-jml-tiket">
							<div class="angka">{{ $value->total }}</div>
							<div class="tiket">Tiket</div>
							<div class="trayek">{{ $value->alias }}</div>
						</div>
					</div>
					@endforeach
				</div>
				
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
				$("#input-bis-trayek").append("<div class='radio'><label><input type='radio' name='bis_trayek' value="+value.id+"><b>"+value.jenis_bis.jenis+" - "+value.jadwal+" WIB</b><p style='font-size:12px;'>"+value.stasiun_asal+" - "+value.stasiun_tujuan+"</p></label></div>");
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


    $('[data-toggle="tooltip"]').tooltip({
		    animated: 'fade',
		    placement: 'top',
		    html: true
		}); 
		

		$('.slider-bis').cycle({ 
			    fx: 'scrollLeft',
			    speed: 300, 
			    timeout: 0, 
			    next: '#next2', 
			    prev: '#prev2' 
			});

		$('#btn-pesan-tiket').click(function() {
			var nomor_kursi = $("input[name='nomor_kursi']").val();
			var penumpang = $("input[name='penumpang']").val();
			var telephone = $("input[name='telephone']").val();
			var domisili_asal = $("input[name='domisili_asal']").val();
			var domisili_tujuann = $("input[name='domisili_tujuan']").val();

			if(!telephone.match(/^[0-9]*(?:\.\d{1,2})?$/))
			{
				$('.text-error').html("Nomor Telepon harus di isi angka");
			}
			else if(penumpang == '' || nomor_kursi == '' || telephone == '' || domisili_asal == '' || domisili_tujuan == '')
			{
				$('.text-error').html("Semua input harus di isi dengan benar");
			}

			return false;
		})

	});
</script>

@endsection