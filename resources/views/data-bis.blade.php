@extends('layout.mainLayout')

@section('content')

<h2 class="content-title">Manajemen Bis</h2>
<a href="{{ url('bis-default') }}" style="font-size:12px;">Bis Default</a> |
<a href="{{ url('bis-berangkat') }}" style="font-size:12px;">Bis Berangkat</a> |
<a href="{{ url('bis') }}" style="font-size:12px;">Bis</a>

<div class="row">
	
	<div class="col-md-6">
		<div class="box-content">
			<table class="table">
				<thead>
					<th>No.</th>
					<th>Jenis Bis</th>
					<th>Plat</th>
					<th>Jumlah Kursi</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($bis as $key => $value)
					<tr>
						<td>{{ $key + 1 }}</td>
						<td>{{ $value->jenis_bis->jenis }}</td>
						<td>{{ $value->plat }}</td>
						<td>{{ $value->jumlah_kursi }}</td>
						<td>
							<a href="#" onclick="deleteBis({{$value->id}})">Delete</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="col-md-6">
		<div class="box-content">
			<form action="" method="POST">
				
				<div class="form-group">
					<label for="">Plat</label>
					<input type="text" name="plat" placeholder="Plat Bis" class="form-control">
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Jenis Bis</label>
							<select name="jenis_bis_id" id="" class="form-control">
								@foreach($jenisBis as $value)
									<option value="{{ $value->id }}">{{ $value->jenis }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Jumlah Kursi</label>
							<select name="jumlah_kursi" id="" class="form-control">
									<option value="22">22</option>
						  		<option value="23">23</option>
						  		<option value="25">25</option>
						  		<option value="26">26</option>
						  		<option value="29">29</option>
						  		<option value="31">31</option>
						  		<option value="33">33</option>
						  		<option value="34">34</option>
						  		<option value="35">35</option>
						  		<option value="37">37</option>
						  		<option value="39">39</option>
						  		<option value="40">40</option>
						  		<option value="48">48</option>
							</select>
						</div>
					</div>
				</div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="submit" value="Tambah Bis" class="btn btn-primary">
			</form>
		</div>
	</div>

</div>

@endsection

@section('script')
<script type="text/javascript">
	function deleteBis(id)
	{
		var c = confirm("apakah anda akan menghapus bis ini?");
		if(c == true)
		{
			window.location = base_url+'/bis-delete/'+id;
		}
	}
</script>
@endsection