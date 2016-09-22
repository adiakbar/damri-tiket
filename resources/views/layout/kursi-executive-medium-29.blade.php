<div class="container-kursi" data-kode-trayek="{{ $bis->kode_trayek }}" data-nomor-bis="{{ $bis->nomor_bis }}" data-bis-id="{{ $bis->bis_id }}">
	<h3 class="bus-title">{{ $bis->nomor_bis }}</h3>
	<div class="baris">
		<div class="pintu">Pintu Depan</div>
		<div class="supir"><i class="fa fa-tachometer"></i></div>
	</div>
	<!-- kursi 1 - 2 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['1'])) {{ $kursi[$bis->nomor_bis]['1'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['1'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['1'].' ('.$telephone[$bis->nomor_bis]['1'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['1'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['1'] }}</p></div>" @endif>
			<input type="checkbox" value="1" name="kursi[]" class="cek-kursi"><span style="padding:4px;">1</span>
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['2'])) {{ $kursi[$bis->nomor_bis]['2'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['2'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['2'].' ('.$telephone[$bis->nomor_bis]['2'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['2'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['2'] }}</p></div>" @endif>
			<input type="checkbox" value="2" name="kursi[]" class="cek-kursi"><span style="padding:4px;">2</span>
		</div>
	</div>
	<!-- kursi 3 - 6 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['3'])) {{ $kursi[$bis->nomor_bis]['3'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['3'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['3'].' ('.$telephone[$bis->nomor_bis]['3'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['3'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['3'] }}</p></div>" @endif>
			<input type="checkbox" value="3" name="kursi[]" class="cek-kursi"><span style="padding:4px;">3</span>
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['4'])) {{ $kursi[$bis->nomor_bis]['4'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['4'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['4'].' ('.$telephone[$bis->nomor_bis]['4'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['4'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['4'] }}</p></div>" @endif>
			<input type="checkbox" value="4" name="kursi[]" class="cek-kursi"><span style="padding:4px;">4</span>
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['5'])) {{ $kursi[$bis->nomor_bis]['5'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['5'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['5'].' ('.$telephone[$bis->nomor_bis]['5'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['5'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['5'] }}</p></div>" @endif>
			<input type="checkbox" value="5" name="kursi[]" class="cek-kursi"><span style="padding:4px;">5</span>
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['6'])) {{ $kursi[$bis->nomor_bis]['6'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['6'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['6'].' ('.$telephone[$bis->nomor_bis]['6'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['6'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['6'] }}</p></div>" @endif>
			<input type="checkbox" value="6" name="kursi[]" class="cek-kursi"><span style="padding:4px;">6</span>
		</div>
	</div>
	<!-- kursi 7 - 10 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['7'])) {{ $kursi[$bis->nomor_bis]['7'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['7'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['7'].' ('.$telephone[$bis->nomor_bis]['7'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['7'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['7'] }}</p></div>" @endif>
			<input type="checkbox" value="7" name="kursi[]" class="cek-kursi"><span style="padding:4px;">7</span>
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['8'])) {{ $kursi[$bis->nomor_bis]['8'] }} @endif" @if(isset($kursi[$bis->nomor_bis]['8'])) {{$kursi[$bis->nomor_bis]['8']}} @endif" @if(isset($penumpang[$bis->nomor_bis]['8'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['8'].' ('.$telephone[$bis->nomor_bis]['8'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['8'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['8'] }}</p></div>" @endif>
			<input type="checkbox" value="8" name="kursi[]" class="cek-kursi"><span style="padding:4px;">8</span>
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['9'])) {{ $kursi[$bis->nomor_bis]['9'] }} @endif" @if(isset($kursi[$bis->nomor_bis]['9'])) {{$kursi[$bis->nomor_bis]['9']}} @endif" @if(isset($penumpang[$bis->nomor_bis]['9'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['9'].' ('.$telephone[$bis->nomor_bis]['9'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['9'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['9'] }}</p></div>" @endif>
			<input type="checkbox" value="9" name="kursi[]" class="cek-kursi"><span style="padding:4px;">9</span>
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['10'])) {{ $kursi[$bis->nomor_bis]['10'] }} @endif" @if(isset($kursi[$bis->nomor_bis]['10'])) {{$kursi[$bis->nomor_bis]['10']}} @endif" @if(isset($penumpang[$bis->nomor_bis]['10'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['10'].' ('.$telephone[$bis->nomor_bis]['10'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['10'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['10'] }}</p></div>" @endif>
			<input type="checkbox" value="10" name="kursi[]" class="cek-kursi">10
		</div>
	</div>
	<!-- kursi 11 - 12 -->
	<div class="baris">
		<div class="pintu" style="margin-top: 8px; margin-right: 37px;">Pintu Tengah</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['11'])) {{ $kursi[$bis->nomor_bis]['11'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['11'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['11'].' ('.$telephone[$bis->nomor_bis]['11'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['11'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['11'] }}</p></div>" @endif>
			<input type="checkbox" value="11" name="kursi[]" class="cek-kursi">11
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['12'])) {{ $kursi[$bis->nomor_bis]['12'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['12'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['12'].' ('.$telephone[$bis->nomor_bis]['12'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['12'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['12'] }}</p></div>" @endif>
			<input type="checkbox" value="12" name="kursi[]" class="cek-kursi">12
		</div>
	</div>
	<!-- kursi 13 - 16 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['15'])) {{ $kursi[$bis->nomor_bis]['15'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['15'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['15'].' ('.$telephone[$bis->nomor_bis]['15'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['15'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['15'] }}</p></div>" @endif>
			<input type="checkbox" value="15" name="kursi[]" class="cek-kursi">15
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['16'])) {{ $kursi[$bis->nomor_bis]['16'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['16'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['16'].' ('.$telephone[$bis->nomor_bis]['16'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['16'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['16'] }}</p></div>" @endif>
			<input type="checkbox" value="16" name="kursi[]" class="cek-kursi">16
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['13'])) {{ $kursi[$bis->nomor_bis]['13'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['13'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['13'].' ('.$telephone[$bis->nomor_bis]['13'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['13'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['13'] }}</p></div>" @endif>
			<input type="checkbox" value="13" name="kursi[]" class="cek-kursi">13
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['14'])) {{ $kursi[$bis->nomor_bis]['14'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['14'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['14'].' ('.$telephone[$bis->nomor_bis]['14'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['14'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['14'] }}</p></div>" @endif>
			<input type="checkbox" value="14" name="kursi[]" class="cek-kursi">14
		</div>
	</div>
	<!-- kursi 17 - 20 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['19'])) {{ $kursi[$bis->nomor_bis]['19'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['19'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['19'].' ('.$telephone[$bis->nomor_bis]['19'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['19'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['19'] }}</p></div>" @endif>
			<input type="checkbox" value="19" name="kursi[]" class="cek-kursi">19
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['20'])) {{ $kursi[$bis->nomor_bis]['20'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['20'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['20'].' ('.$telephone[$bis->nomor_bis]['20'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['20'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['20'] }}</p></div>" @endif>
			<input type="checkbox" value="20" name="kursi[]" class="cek-kursi">20
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['17'])) {{ $kursi[$bis->nomor_bis]['17'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['17'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['17'].' ('.$telephone[$bis->nomor_bis]['17'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['17'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['17'] }}</p></div>" @endif>
			<input type="checkbox" value="17" name="kursi[]" class="cek-kursi">17
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['18'])) {{ $kursi[$bis->nomor_bis]['18'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['18'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['18'].' ('.$telephone[$bis->nomor_bis]['18'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['18'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['18'] }}</p></div>" @endif>
			<input type="checkbox" value="18" name="kursi[]" class="cek-kursi">18
		</div>
	</div>
	<!-- kursi 21 - 24 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['23'])) {{ $kursi[$bis->nomor_bis]['23'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['23'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['23'].' ('.$telephone[$bis->nomor_bis]['23'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['23'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['23'] }}</p></div>" @endif>
			<input type="checkbox" value="23" name="kursi[]" class="cek-kursi">23
		</div>
		<div class="kursi space @if(isset($kursi[$bis->nomor_bis]['24'])) {{ $kursi[$bis->nomor_bis]['24'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['24'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['24'].' ('.$telephone[$bis->nomor_bis]['24'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['24'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['24'] }}</p></div>" @endif>
			<input type="checkbox" value="24" name="kursi[]" class="cek-kursi">24
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['21'])) {{ $kursi[$bis->nomor_bis]['21'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['21'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['21'].' ('.$telephone[$bis->nomor_bis]['21'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['21'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['21'] }}</p></div>" @endif>
			<input type="checkbox" value="21" name="kursi[]" class="cek-kursi">21
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['22'])) {{ $kursi[$bis->nomor_bis]['22'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['22'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['22'].' ('.$telephone[$bis->nomor_bis]['22'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['22'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['22'] }}</p></div>" @endif>
			<input type="checkbox" value="22" name="kursi[]" class="cek-kursi">22
		</div>
	</div>
	<!-- kursi 25 - 29 -->
	<div class="baris">
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['25'])) {{ $kursi[$bis->nomor_bis]['25'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['25'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['25'].' ('.$telephone[$bis->nomor_bis]['25'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['25'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['25'] }}</p></div>" @endif>
			<input type="checkbox" value="25" name="kursi[]" class="cek-kursi">25
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['26'])) {{ $kursi[$bis->nomor_bis]['26'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['26'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['26'].' ('.$telephone[$bis->nomor_bis]['26'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['26'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['26'] }}</p></div>" @endif>
			<input type="checkbox" value="26" name="kursi[]" class="cek-kursi">26
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['27'])) {{ $kursi[$bis->nomor_bis]['27'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['27'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['27'].' ('.$telephone[$bis->nomor_bis]['27'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['27'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['27'] }}</p></div>" @endif>
			<input type="checkbox" value="27" name="kursi[]" class="cek-kursi">27
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['28'])) {{ $kursi[$bis->nomor_bis]['28'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['28'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['28'].' ('.$telephone[$bis->nomor_bis]['28'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['28'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['28'] }}</p></div>" @endif>
			<input type="checkbox" value="28" name="kursi[]" class="cek-kursi">28
		</div>
		<div class="kursi @if(isset($kursi[$bis->nomor_bis]['29'])) {{ $kursi[$bis->nomor_bis]['29'] }} @endif" @if(isset($penumpang[$bis->nomor_bis]['29'])) data-toggle="tooltip" title="<div class='box-tooltip'><p>{{ $penumpang[$bis->nomor_bis]['29'].' ('.$telephone[$bis->nomor_bis]['29'].')' }}</p><p>Asal: {{ $asal[$bis->nomor_bis]['29'] }}</p><p>Tujuan: {{ $tujuan[$bis->nomor_bis]['29'] }}</p></div>" @endif>
			<input type="checkbox" value="29" name="kursi[]" class="cek-kursi">29
		</div>
	</div>
</div>