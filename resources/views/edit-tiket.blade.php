@extends('layout.mainLayout')

@section('content')

<h2 class="content-title">Edit Tiket</h2>

<div class="row">
	<div class="col-md-4">
		<div class="box-content">
			<h4 style="color: #3498db;">Trayek</h4>
			<p><b>Tanggal</b> : {{ \App\Convert::TanggalIndo($pesanan->tanggal) }}</p>
			<p><b>Harga</b> : {{ "Rp ".number_format($pesanan->jenis_bis_trayek->harga,0,',','.') }}</p>
			<p style="margin-bottom:0;"><b>{{ $pesanan->jenis_bis_trayek->jenis_bis->jenis.' | '. $pesanan->jenis_bis_trayek->jadwal.' WIB' }}</b></p>
			<p style="font-size:12px;">{{ $pesanan->jenis_bis_trayek->stasiun_asal.' - '.$pesanan->jenis_bis_trayek->stasiun_tujuan }}</p>
		</div>
	</div>
	<div class="col-md-8">
		<div class="box-content">
			<form style="margin-top: 15px;" action="{{ url('update-tiket') }}" method="POST" id="form-pesan-tiket">
				@if(session('warning'))
					<div class="alert alert-danger" style="padding: 5px;">
				        {{ session('warning') }}
				    </div>
				@endif
				
				<div class="form-group">
			    <label for="">Nomor Kursi : <span class="span-required">*wajib di isi</span></label>
			    <input type="text" class="form-control" disabled="" value="{{ $pesanan->nomor_kursi }}">
			  </div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
					    <label for="">Nama : <span class="span-required">*wajib di isi</span></label>
					    <input type="text" name="penumpang" class="form-control" placeholder="Nama" value="{{ $pesanan->penumpang }}">
					  </div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
					    <label for="">Nomor Telepon : <span class="span-required">*wajib di isi</span></label>
					    <input type="text" name="telephone" class="form-control" placeholder="Telephone" value="{{ $pesanan->telephone }}">
					  </div>
					</div>
				</div>
			  <div class="row">
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="">Domisili Asal : <span class="span-required">*wajib di isi</span></label>
					    <input type="text" name="domisili_asal" class="form-control" placeholder="Domisi Asal" value="{{ $pesanan->domisili_asal }}">
					  </div>
			  	</div>
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="">Domisili Tujuan : <span class="span-required">*wajib di isi</span></label>
					    <input type="text" name="domisili_tujuan" class="form-control" placeholder="Domisi Tujuan" value="{{ $pesanan->domisili_tujuan }}">
					  </div>
			  	</div>
			  </div>
			  <div class="row">
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="">Passport : </label>
					    <input type="text" name="passport" class="form-control" placeholder="Passport" value="{{ $pesanan->passport }}">
					  </div>
			  	</div>
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="">Masa Berlaku : </label>
					    <input type="text" name="masa_berlaku" class="form-control" placeholder="Masa Berlaku" value="{{ $pesanan->masa_berlaku }}">
					  </div>
			  	</div>
			  </div>
			  <div class="row">
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="">Tempat Lahir </label>
					    <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ $pesanan->tempat_lahir }}">
					  </div>
			  	</div>
			  	<div class="col-md-6">
			  		<div class="form-group">
					    <label for="">Tanggal Lahir </label>
					    <input type="text" name="tanggal_lahir" class="form-control" data-provide="datepicker" data-date-format="dd MM yyyy" placeholder="Tanggal Lahir" value="{{ $pesanan->tanggal_lahir }}">
					  </div>
			  	</div>
			  </div>
			  <div class="form-group">
			    <label for="">Keterangan : </label>
			    <textarea name="keterangan" class="form-control">{{ $pesanan->keterangan }}</textarea>
			  </div>
			  <input type="hidden" name="nomor_kursi" value="{{ $pesanan->nomor_kursi}}">
			  <input type="hidden" name="kode_trayek" value="{{ $pesanan->kode_trayek }}">
			  <input type="hidden" name="nomor_bis" value="{{ $pesanan->nomor_bis }}">
			  <input type="hidden" name="bis_id" value="{{ $pesanan->bis_id }}">
			  <input type="hidden" name="tanggal" value="{{ $pesanan->tanggal }}">
			  <input type="hidden" name="jenis_bis_trayek_id" value="{{ $pesanan->jenis_bis_trayek_id }}">
			  <input type="hidden" name="petugas_id" value="{{ Auth::user()->id }}">
			  <input type="hidden" name="trayek_id" value="{{ $pesanan->trayek_id }}">
			  <input type="hidden" name="status" value="{{ $pesanan->status }}">
			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
			  <input type="hidden" name="id" value="{{ $pesanan->id }}">
				<p class="text-error"></p>
				<button class="btn btn-warning" id="btn-edit-tiket">Update Tiket</button>
			</form>
		</div>
	</div>
</div>

@endsection

@section('script')
<script type="text/javascript">
	$('#btn-edit-tiket').click(function() {
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
</script>
@endsection