@extends('layout.mainLayout')

@section('content')

<div class="cover">
	<div class="icon-loading">
		<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
	</div>
</div>

<h2 class="content-title" style="display: inline-block">Tiket</h2>

	<a href="{{ url('/?tanggal='.$tanggal_link.'&bis_trayek='.$bis_trayek_link.'&_token='.csrf_token()) }}" class="btn btn-danger" style="float:right; margin-left: 10px;">Selesai</a>
	<form action="" style="float:right;">
		<input type="hidden" id="pesanan_id" name="pesanan_id">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="button" value="Bayar dan Cetak Tiket" id="btn_bayar_tiket" class="btn btn-success">
	</form>



<div class="row">
	@foreach($pesanan as $value)
	<div class="col-md-3">
		<div class="box-content tiket-penumpang">
			<p class="text-labelbis">{{ $value->jenis_bis_trayek->jenis_bis->jenis }}</p>
			<p class="text-labelkursi">{{ $value->nomor_kursi }}</p>
			<p class="text-label">{{ App\Convert::TanggalIndo($value->tanggal) }}</p>
			<p style="font-size:12px;">{{ $value->jenis_bis_trayek->stasiun_asal.' - '.$value->jenis_bis_trayek->stasiun_tujuan.' ('.$value->jenis_bis_trayek->jadwal.')' }}</p>
			<p class="text-label">Nama</p>
			<p>{{ $value->penumpang }}</p>
			<p class="text-label">Kode Tiket</p>
			<p id="{{ 'kode-tiket-'.$value->id }}">{{ ($value->numeratur == '' ? '-' : $value->numeratur) }}</p>
			<div class="row">
				<div class="col-md-6">
					<p class="text-label">Telepon</p>
					<p>{{ $value->telephone }}</p>
				</div>
				<div class="col-md-6">
					<p class="text-label">Status</p>
					<p id="{{ 'status-tiket-'.$value->id }}">{{ ucfirst($value->status) }}</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="text-label">Harga</p>
					<p>{{  "Rp ".number_format($value->jenis_bis_trayek->harga,0,',','.')  }}</p>
				</div>
				<div class="col-md-6">
					<p class="text-label">Passport</p>
					<p>{{ ($value->passport == '' ? '-' : $value->passport) }}</p>
				</div>
			</div>
			<p class="text-label">Keterangan</p>
			<p>{{ ($value->keterangan  == '' ? '-' : $value->keterangan) }}</p>
			<input type="checkbox" value="{{ $value->id }}" name="pesanan[]" style="display:none;">
		</div>
	</div>
	@endforeach
</div>

@endsection

@section('script')

<script type="text/javascript">
	$(document).ready(function() {

		var tiket;
		$('.tiket-penumpang').click(function() {
			$(this).children('input').trigger('click');
			tiket = $('input:checkbox:checked').map(function(){
					return $(this).val();
				}).get();

			if($(this).children('input').prop('checked') == false) 
			{
				$(this).removeClass('highlight');
			}
			else
			{
				$(this).addClass('highlight');
			}

			$('#pesanan_id').val(tiket.join());
		});

		$('#btn_bayar_tiket').click(function() {
			var pesanan_id = $('#pesanan_id').val();
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

						window.open('cetak-tiket?pesanan_id='+pesanan_id,'print','location=0');
					}
				});
			}
		});

	});
</script>

@endsection