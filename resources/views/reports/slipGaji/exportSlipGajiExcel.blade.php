<table>
	<tr>
		<td style="font-weight: bold; border: 2px solid black;">Periode</td>
		<td style="border: 2px solid black;">: {{ \Carbon\Carbon::parse(request()->periode)->translatedFormat('F Y') }}</td>
	</tr>
</table>

<table>
	<thead>
		<tr>
			<th style="border: 2px solid black; font-weight: bold;">NIK</th>
			<th style="border: 2px solid black; font-weight: bold;">Nama</th>
			<th style="border: 2px solid black; font-weight: bold;">Total Pendapatan</th>
			<th style="border: 2px solid black; font-weight: bold;">Total Pengurangan</th>
			<th style="border: 2px solid black; font-weight: bold;">Penghasilan Bersih</th>
		</tr>
	</thead>
	<tbody>
		@foreach($slipGajiKaryawan as $slipGaji)
			@php
			    $gajiPokok      = $slipGaji->karyawan->bagian->gaji_pokok;
			    $insentifNetTur = $slipGaji->insentif_net_tur;
			    $tunjanganUmp   = $slipGaji->tunjangan_ump;
			    $fasilitasMMS   = $slipGaji->fasilitas_mms;
			    $bonusInsentif  = $slipGaji->bonus_insentif;
			    $tunjanganHPMMS = $slipGaji->tunjangan_hp_mms;
			    $gajiBersih     = intval($gajiPokok + $tunjanganUmp);
			    $jhtDua         = intval($gajiBersih * 0.02);
			    $jhtTigaKomaTujuh   = intval($gajiBersih * 0.037);
			    $jkkNolKomaDuaEmpat = intval($gajiBersih * 0.0024);
			    $jkmNolKomaTiga     = intval($gajiBersih * 0.003);
			    $jpSatu         = intval($gajiBersih * 0.01);
			    $jpDua          = intval($gajiBersih * 0.02);
			    $BPJSPerusahaan = intval($gajiBersih * 0.04);
			    $BPJSKaryawan   = intval($gajiBersih * 0.01);

			    $totalPendapatan    = intval($gajiBersih + $insentifNetTur + $jhtTigaKomaTujuh + $jkkNolKomaDuaEmpat + $jkmNolKomaTiga + $BPJSPerusahaan + $bonusInsentif + $jpDua + $tunjanganHPMMS + $fasilitasMMS);
			    $totalPengurangan   = intval($jhtDua + $jhtTigaKomaTujuh + $jkkNolKomaDuaEmpat + $jkmNolKomaTiga + $BPJSPerusahaan + $BPJSKaryawan + $jpDua + $jpSatu + $fasilitasMMS);
			    $penghasilanBersih  = intval($totalPendapatan - $totalPengurangan);
			@endphp
		<tr>
			<td style="border: 2px solid black;">{{ $slipGaji->karyawan->nik }}</td>
			<td style="border: 2px solid black;">{{ Str::upper($slipGaji->karyawan->nama) }}</td>
			<td style="border: 2px solid black;">Rp. {{ strrev(implode('.', str_split(strrev(strval($totalPendapatan)), 3))) }}</td>
			<td style="border: 2px solid black;">Rp. {{ strrev(implode('.', str_split(strrev(strval($totalPengurangan)), 3))) }}</td>
			<td style="border: 2px solid black;">Rp. {{ strrev(implode('.', str_split(strrev(strval($penghasilanBersih)), 3))) }}</td>
		</tr>
		@endforeach
	</tbody>
</table>