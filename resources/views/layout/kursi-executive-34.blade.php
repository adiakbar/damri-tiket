<div class="container-kursi" data-kode-trayek="{{ $bis->kode_trayek }}" data-nomor-bis="{{ $bis->nomor_bis }}" data-bis-id="{{ $bis->bis_id }}">
	<h3 class="bus-title">{{ $bis->nomor_bis }}</h3>
	<div class="baris">
		<div class="pintu">Pintu Depan</div>
		<div class="supir"><i class="fa fa-tachometer"></i></div>
	</div>
	<!-- kursi 1 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['1A'])) {{ $kursi[$bis->nomor_bis]['1A'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['1A'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['1A'].' ('.$telephone[$bis->nomor_bis]['1A'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['1A'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['1A'] }}</p></div>" @endif>
			<input type="checkbox" value="1A" name="kursi[]" class="cek-kursi">1A
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['1B'])) {{ $kursi[$bis->nomor_bis]['1B'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['1B'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['1B'].' ('.$telephone[$bis->nomor_bis]['1B'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['1B'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['1B'] }}</p></div>" @endif>
			<input type="checkbox" value="1B" name="kursi[]" class="cek-kursi">1B
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['1C'])) {{ $kursi[$bis->nomor_bis]['1C'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['1C'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['1C'].' ('.$telephone[$bis->nomor_bis]['1C'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['1C'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['1C'] }}</p></div>" @endif>
			<input type="checkbox" value="1C" name="kursi[]" class="cek-kursi">1C
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['1D'])) {{ $kursi[$bis->nomor_bis]['1D'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['1D'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['1D'].' ('.$telephone[$bis->nomor_bis]['1D'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['1D'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['1D'] }}</p></div>" @endif>
			<input type="checkbox" value="1D" name="kursi[]" class="cek-kursi">1D
		</div>
	</div>
	<!-- kursi 2 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['2A'])) {{ $kursi[$bis->nomor_bis]['2A'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['2A'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['2A'].' ('.$telephone[$bis->nomor_bis]['2A'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['2A'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['2A'] }}</p></div>" @endif>
			<input type="checkbox" value="2A" name="kursi[]" class="cek-kursi">2A
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['2B'])) {{ $kursi[$bis->nomor_bis]['2B'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['2B'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['2B'].' ('.$telephone[$bis->nomor_bis]['2B'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['2B'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['2B'] }}</p></div>" @endif>
			<input type="checkbox" value="2B" name="kursi[]" class="cek-kursi">2B
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['2C'])) {{ $kursi[$bis->nomor_bis]['2C'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['2C'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['2C'].' ('.$telephone[$bis->nomor_bis]['2C'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['2C'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['2C'] }}</p></div>" @endif>
			<input type="checkbox" value="2C" name="kursi[]" class="cek-kursi">2C
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['2D'])) {{ $kursi[$bis->nomor_bis]['2D'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['2D'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['2D'].' ('.$telephone[$bis->nomor_bis]['2D'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['2D'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['2D'] }}</p></div>" @endif>
			<input type="checkbox" value="2D" name="kursi[]" class="cek-kursi">2D
		</div>
	</div>
	<!-- kursi 3 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['3A'])) {{ $kursi[$bis->nomor_bis]['3A'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['3A'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['3A'].' ('.$telephone[$bis->nomor_bis]['3A'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['3A'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['3A'] }}</p></div>" @endif>
			<input type="checkbox" value="3A" name="kursi[]" class="cek-kursi">3A
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['3B'])) {{ $kursi[$bis->nomor_bis]['3B'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['3B'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['3B'].' ('.$telephone[$bis->nomor_bis]['3B'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['3B'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['3B'] }}</p></div>" @endif>
			<input type="checkbox" value="3B" name="kursi[]" class="cek-kursi">3B
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['3C'])) {{ $kursi[$bis->nomor_bis]['3C'] }} @endif" @if(isset($kursi[$bis->nomor_bis]['3C'])) {{$kursi[$bis->nomor_bis]['3C']}} @endif" @if(isset($penumpang[$bis->nomor_bis]['3C'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['3C'].' ('.$telephone[$bis->nomor_bis]['3C'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['3C'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['3C'] }}</p></div>" @endif>
			<input type="checkbox" value="3C" name="kursi[]" class="cek-kursi">3C
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['3D'])) {{ $kursi[$bis->nomor_bis]['3D'] }} @endif" @if(isset($kursi[$bis->nomor_bis]['3D'])) {{$kursi[$bis->nomor_bis]['3D']}} @endif" @if(isset($penumpang[$bis->nomor_bis]['3D'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['3D'].' ('.$telephone[$bis->nomor_bis]['3D'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['3D'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['3D'] }}</p></div>" @endif>
			<input type="checkbox" value="3D" name="kursi[]" class="cek-kursi">3D
		</div>
	</div>
	<!-- kursi 4 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['4A'])) {{ $kursi[$bis->nomor_bis]['4A'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['4A'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['4A'].' ('.$telephone[$bis->nomor_bis]['4A'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['4A'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['4A'] }}</p></div>" @endif>
			<input type="checkbox" value="4A" name="kursi[]" class="cek-kursi">4A
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['4B'])) {{ $kursi[$bis->nomor_bis]['4B'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['4B'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['4B'].' ('.$telephone[$bis->nomor_bis]['4B'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['4B'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['4B'] }}</p></div>" @endif>
			<input type="checkbox" value="4B" name="kursi[]" class="cek-kursi">4B
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['4C'])) {{ $kursi[$bis->nomor_bis]['4C'] }} @endif" @if(isset($kursi[$bis->nomor_bis]['4C'])) {{$kursi[$bis->nomor_bis]['4C']}} @endif" @if(isset($penumpang[$bis->nomor_bis]['4C'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['4C'].' ('.$telephone[$bis->nomor_bis]['4C'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['4C'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['4C'] }}</p></div>" @endif>
			<input type="checkbox" value="4C" name="kursi[]" class="cek-kursi">4C
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['4D'])) {{ $kursi[$bis->nomor_bis]['4D'] }} @endif" @if(isset($kursi[$bis->nomor_bis]['4D'])) {{$kursi[$bis->nomor_bis]['4D']}} @endif" @if(isset($penumpang[$bis->nomor_bis]['4D'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['4D'].' ('.$telephone[$bis->nomor_bis]['4D'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['4D'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['4D'] }}</p></div>" @endif>
			<input type="checkbox" value="4D" name="kursi[]" class="cek-kursi">4D
		</div>
	</div>
	<!-- kursi 5 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['5A'])) {{ $kursi[$bis->nomor_bis]['5A'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['5A'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['5A'].' ('.$telephone[$bis->nomor_bis]['5A'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['5A'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['5A'] }}</p></div>" @endif>
			<input type="checkbox" value="5A" name="kursi[]" class="cek-kursi">5A
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['5B'])) {{ $kursi[$bis->nomor_bis]['5B'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['5B'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['5B'].' ('.$telephone[$bis->nomor_bis]['5B'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['5B'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['5B'] }}</p></div>" @endif>
			<input type="checkbox" value="5B" name="kursi[]" class="cek-kursi">5B
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['5C'])) {{ $kursi[$bis->nomor_bis]['5C'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['5C'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['5C'].' ('.$telephone[$bis->nomor_bis]['5C'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['5C'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['5C'] }}</p></div>" @endif>
			<input type="checkbox" value="5C" name="kursi[]" class="cek-kursi">5C
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['5D'])) {{ $kursi[$bis->nomor_bis]['5D'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['5D'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['5D'].' ('.$telephone[$bis->nomor_bis]['5D'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['5D'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['5D'] }}</p></div>" @endif>
			<input type="checkbox" value="5D" name="kursi[]" class="cek-kursi">5D
		</div>
	</div>
	<!-- kursi 6 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['6A'])) {{ $kursi[$bis->nomor_bis]['6A'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['6A'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['6A'].' ('.$telephone[$bis->nomor_bis]['6A'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['6A'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['6A'] }}</p></div>" @endif>
			<input type="checkbox" value="6A" name="kursi[]" class="cek-kursi">6A
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['6B'])) {{ $kursi[$bis->nomor_bis]['6B'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['6B'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['6B'].' ('.$telephone[$bis->nomor_bis]['6B'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['6B'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['6B'] }}</p></div>" @endif>
			<input type="checkbox" value="6B" name="kursi[]" class="cek-kursi">6B
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['6C'])) {{ $kursi[$bis->nomor_bis]['6C'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['6C'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['6C'].' ('.$telephone[$bis->nomor_bis]['6C'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['6C'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['6C'] }}</p></div>" @endif>
			<input type="checkbox" value="6C" name="kursi[]" class="cek-kursi">6C
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['6D'])) {{ $kursi[$bis->nomor_bis]['6D'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['6D'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['6D'].' ('.$telephone[$bis->nomor_bis]['6D'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['6D'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['6D'] }}</p></div>" @endif>
			<input type="checkbox" value="6D" name="kursi[]" class="cek-kursi">6D
		</div>
	</div>
	<!-- kursi 7 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['7A'])) {{ $kursi[$bis->nomor_bis]['7A'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['7A'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['7A'].' ('.$telephone[$bis->nomor_bis]['7A'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['7A'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['7A'] }}</p></div>" @endif>
			<input type="checkbox" value="7A" name="kursi[]" class="cek-kursi">7A
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['7B'])) {{ $kursi[$bis->nomor_bis]['7B'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['7B'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['7B'].' ('.$telephone[$bis->nomor_bis]['7B'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['7B'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['7B'] }}</p></div>" @endif>
			<input type="checkbox" value="7B" name="kursi[]" class="cek-kursi">7B
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['7C'])) {{ $kursi[$bis->nomor_bis]['7C'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['7C'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['7C'].' ('.$telephone[$bis->nomor_bis]['7C'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['7C'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['7C'] }}</p></div>" @endif>
			<input type="checkbox" value="7C" name="kursi[]" class="cek-kursi">7C
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['7D'])) {{ $kursi[$bis->nomor_bis]['7D'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['7D'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['7D'].' ('.$telephone[$bis->nomor_bis]['7D'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['7D'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['7D'] }}</p></div>" @endif>
			<input type="checkbox" value="7D" name="kursi[]" class="cek-kursi">7D
		</div>
	</div>
	<!-- kursi 8 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['8A'])) {{ $kursi[$bis->nomor_bis]['8A'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['8A'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['8A'].' ('.$telephone[$bis->nomor_bis]['8A'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['8A'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['8A'] }}</p></div>" @endif>
			<input type="checkbox" value="8A" name="kursi[]" class="cek-kursi">8A
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['8B'])) {{ $kursi[$bis->nomor_bis]['8B'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['8A'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['8A'].' ('.$telephone[$bis->nomor_bis]['8A'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['8A'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['8A'] }}</p></div>" @endif>
			<input type="checkbox" value="8B" name="kursi[]" class="cek-kursi">8B
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['8C'])) {{ $kursi[$bis->nomor_bis]['8C'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['8C'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['8C'].' ('.$telephone[$bis->nomor_bis]['8C'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['8C'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['8C'] }}</p></div>" @endif>
			<input type="checkbox" value="8C" name="kursi[]" class="cek-kursi">8C
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['8D'])) {{ $kursi[$bis->nomor_bis]['8D'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['8D'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['8D'].' ('.$telephone[$bis->nomor_bis]['8D'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['8D'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['8D'] }}</p></div>" @endif>
			<input type="checkbox" value="8D" name="kursi[]" class="cek-kursi">8D
		</div>
	</div>
	<div class="baris">
		<div class="pintu" style="margin-top: 0;">Pintu Belakang</div>
	</div>
	<div class="baris">
	<div class="toilet">
		<i class="fa fa-recycle"></i>
	</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['9A'])) {{ $kursi[$bis->nomor_bis]['9A'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['9A'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['9A'].' ('.$telephone[$bis->nomor_bis]['9A'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['9A'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['9A'] }}</p></div>" @endif>
			<input type="checkbox" value="9A" name="kursi[]" class="cek-kursi">9A
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['9B'])) {{ $kursi[$bis->nomor_bis]['9B'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['9B'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['9B'].' ('.$telephone[$bis->nomor_bis]['9B'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['9B'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['9B'] }}</p></div>" @endif>
			<input type="checkbox" value="9B" name="kursi[]" class="cek-kursi">9B
		</div>
	</div>
</div>