<div class="container-kursi" data-kode-trayek="{{ $bis->kode_trayek }}" data-nomor-bis="{{ $bis->nomor_bis }}" data-bis-id="{{ $bis->bis_id }}">
	<h3 class="bus-title">{{ $bis->nomor_bis }}</h3>
	<div class="baris">
		<div class="pintu">Pintu Depan</div>
		<div class="supir"><i class="fa fa-tachometer"></i></div>
	</div>
	<!-- kursi 1 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['1A'])) {{ $kursi[$bis->nomor_bis]['1A'] }} @endif">
			<input type="checkbox" value="1A" name="kursi[]" class="cek-kursi">1A
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['1B'])) {{ $kursi[$bis->nomor_bis]['1B'] }} @endif">
			<input type="checkbox" value="1B" name="kursi[]" class="cek-kursi">1B
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['1C'])) {{ $kursi[$bis->nomor_bis]['1C'] }} @endif">
			<input type="checkbox" value="1C" name="kursi[]" class="cek-kursi">1C
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['1D'])) {{ $kursi[$bis->nomor_bis]['1D'] }} @endif">
			<input type="checkbox" value="1D" name="kursi[]" class="cek-kursi">1D
		</div>
	</div>
	<!-- kursi 2 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['2A'])) {{ $kursi[$bis->nomor_bis]['2A'] }} @endif">
			<input type="checkbox" value="2A" name="kursi[]" class="cek-kursi">2A
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['2B'])) {{ $kursi[$bis->nomor_bis]['2B'] }} @endif">
			<input type="checkbox" value="2B" name="kursi[]" class="cek-kursi">2B
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['2C'])) {{ $kursi[$bis->nomor_bis]['2C'] }} @endif">
			<input type="checkbox" value="2C" name="kursi[]" class="cek-kursi">2C
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['2D'])) {{ $kursi[$bis->nomor_bis]['2D'] }} @endif">
			<input type="checkbox" value="2D" name="kursi[]" class="cek-kursi">2D
		</div>
	</div>
	<!-- kursi 3 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['3A'])) {{ $kursi[$bis->nomor_bis]['3A'] }} @endif">
			<input type="checkbox" value="3A" name="kursi[]" class="cek-kursi">3A
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['3B'])) {{ $kursi[$bis->nomor_bis]['3B'] }} @endif">
			<input type="checkbox" value="3B" name="kursi[]" class="cek-kursi">3B
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['3C'])) {{ $kursi[$bis->nomor_bis]['3C'] }} @endif">
			<input type="checkbox" value="3C" name="kursi[]" class="cek-kursi">3C
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['3D'])) {{ $kursi[$bis->nomor_bis]['3D'] }} @endif">
			<input type="checkbox" value="3D" name="kursi[]" class="cek-kursi">3D
		</div>
	</div>
	<!-- kursi 4 -->
	<div class="baris">
		<div class="pintu" style="margin-top: 8px; margin-right: 30px;">Pintu Tengah</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['4A'])) {{ $kursi[$bis->nomor_bis]['4A'] }} @endif">
			<input type="checkbox" value="4A" name="kursi[]" class="cek-kursi">4A
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['4B'])) {{ $kursi[$bis->nomor_bis]['4B'] }} @endif">
			<input type="checkbox" value="4B" name="kursi[]" class="cek-kursi">4B
		</div>
	</div>
	<!-- kursi 5 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['5A'])) {{ $kursi[$bis->nomor_bis]['5A'] }} @endif">
			<input type="checkbox" value="5A" name="kursi[]" class="cek-kursi">5A
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['5B'])) {{ $kursi[$bis->nomor_bis]['5B'] }} @endif">
			<input type="checkbox" value="5B" name="kursi[]" class="cek-kursi">5B
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['5C'])) {{ $kursi[$bis->nomor_bis]['5C'] }} @endif">
			<input type="checkbox" value="5C" name="kursi[]" class="cek-kursi">5C
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['5D'])) {{ $kursi[$bis->nomor_bis]['5D'] }} @endif">
			<input type="checkbox" value="5D" name="kursi[]" class="cek-kursi">5D
		</div>
	</div>
	<!-- kursi 6 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['6A'])) {{ $kursi[$bis->nomor_bis]['6A'] }} @endif">
			<input type="checkbox" value="6A" name="kursi[]" class="cek-kursi">6A
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['6B'])) {{ $kursi[$bis->nomor_bis]['6B'] }} @endif">
			<input type="checkbox" value="6B" name="kursi[]" class="cek-kursi">6B
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['6C'])) {{ $kursi[$bis->nomor_bis]['6C'] }} @endif">
			<input type="checkbox" value="6C" name="kursi[]" class="cek-kursi">6C
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['6D'])) {{ $kursi[$bis->nomor_bis]['6D'] }} @endif">
			<input type="checkbox" value="6D" name="kursi[]" class="cek-kursi">6D
		</div>
	</div>
	<!-- kursi 7 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['7A'])) {{ $kursi[$bis->nomor_bis]['7A'] }} @endif">
			<input type="checkbox" value="7A" name="kursi[]" class="cek-kursi">7A
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['7B'])) {{ $kursi[$bis->nomor_bis]['7B'] }} @endif">
			<input type="checkbox" value="7B" name="kursi[]" class="cek-kursi">7B
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['7C'])) {{ $kursi[$bis->nomor_bis]['7C'] }} @endif">
			<input type="checkbox" value="7C" name="kursi[]" class="cek-kursi">7C
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['7C'])) {{ $kursi[$bis->nomor_bis]['7C'] }} @endif">
			<input type="checkbox" value="7C" name="kursi[]" class="cek-kursi">7C
		</div>
	</div>
</div>