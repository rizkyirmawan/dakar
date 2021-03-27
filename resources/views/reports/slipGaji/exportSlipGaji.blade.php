<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>[Slip Gaji] {{ $slipGaji->karyawan->nama . ' (' . \Carbon\Carbon::parse($slipGaji->periode)->translatedFormat('F Y') . ')' }}</title>
</head>
<body>
	<table width="100%">
		<tr>
			<td rowspan="2" valign="bottom" style="font-weight: bold;">PRIBADI DAN RAHASIA <br>SLIP GAJI KARYAWAN</td>
			<td style="text-align: right;"><img src="{{ public_path('img/logo.jpg') }}" width="100"></td>
		</tr>
		<tr>
			<td style="text-align: right;">{{ Str::upper(\Carbon\Carbon::parse($slipGaji->periode)->translatedFormat('F Y')) }}</td>
		</tr>
	</table>
	<hr>

  <table width="100%">
    <tr>
      <td style="font-weight: bold;">NAMA</td>
      <td>: {{ $slipGaji->karyawan->nama }}</td>
      <td style="font-weight: bold;">POSISI</td>
      <td>: {{ ($slipGaji->karyawan->user->role == 'CO' ? 'COMMUNITY OFFICER' : '') }}</td>
    </tr>
    <tr>
      <td style="font-weight: bold;">NIK</td>
      <td>: {{ $slipGaji->karyawan->nik }}</td>
      <td style="font-weight: bold;">ORGANISASI</td>
      <td>: {{ 'MMS ' . Str::upper($slipGaji->karyawan->bagian->nama_bagian) }}</td>
    </tr>
    <tr>
      <td style="font-weight: bold;">STATUS</td>
      <td>: {{ $slipGaji->karyawan->status_pekerja }}</td>
      <td style="font-weight: bold;">LOKASI</td>
      <td>: {{ 'MMS ' . Str::upper($slipGaji->karyawan->bagian->nama_bagian) }}</td>
    </tr>
    <tr>
      <td style="font-weight: bold;">TAX MARITAL</td>
      <td>: 50</td>
      <td style="font-weight: bold;">GRADE</td>
      <td>: {{ $slipGaji->karyawan->user->role . $slipGaji->insentif_level . ': ' . ($slipGaji->karyawan->user->role == 'CO' ? 'COMMUNITY OFFICER' : '') . ' ' . $slipGaji->insentif_level }}</td>
    </tr>
  </table>

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

	<h3>PENDAPATAN</h3>
	<hr>
    <table width="100%">
      <tr>
        <td>GAJI POKOK NET</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($gajiPokok)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>TUNJANGAN JHT 3.7%</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jhtTigaKomaTujuh)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>TUNJANGAN JKK 0.24%</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jkkNolKomaDuaEmpat)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>TUNJANGAN JKM 0.3%</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jkmNolKomaTiga)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>INSENTIF NET TUR</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($insentifNetTur)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>TUNJANGAN UMP</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($tunjanganUmp)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>TUNJANGAN BPJS PERUSAHAAN 4%</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($BPJSPerusahaan)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>INSENTIF LEVEL {{ $slipGaji->insentif_level }}</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($bonusInsentif)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>TUNJANGAN JP 2%</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jpDua)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>TUNJANGAN HP MMS</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($tunjanganHPMMS)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>FASILITAS MMS</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($fasilitasMMS)), 3))) }}</span></td>
      </tr>
      <tr>
        <td style="font-weight: bold;">TOTAL PENDAPATAN</td>
        <td style="font-weight: bold;">Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($totalPendapatan)), 3))) }}</span></td>
      </tr>
    </table>

    <h3>PENGURANGAN</h3>
    <hr>
    <table width="100%">
      <tr>
        <td>JHT PREMIUM 2%</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jhtDua)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>JHT PREMIUM 3.7%</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jhtTigaKomaTujuh)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>JKK PREMIUM 0.24%</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jkkNolKomaDuaEmpat)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>JKM PREMIUM 0.3%</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jkmNolKomaTiga)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>POT BPJS PERUSAHAAN 4%</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($BPJSPerusahaan)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>POT BPJS KARYAWAN</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($BPJSKaryawan)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>POT JP PREMIUM 2%</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jpDua)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>POT JP PREMIUM 1%</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jpSatu)), 3))) }}</span></td>
      </tr>
      <tr>
        <td>FASILITAS MMS</td>
        <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($fasilitasMMS)), 3))) }}</span></td>
      </tr>
      <tr>
        <td style="font-weight: bold;">TOTAL PENGURANGAN</td>
        <td style="font-weight: bold;">Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($totalPengurangan)), 3))) }}</span></td>
      </tr>
    </table>

    <h3>PENGHASILAN BERSIH</h3>
    <hr>
    <table width="100%">
      <tr>
        <td style="font-weight: bold;">PENGHASILAN BERSIH</td>
        <td style="font-weight: bold;">Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($penghasilanBersih)), 3))) }}</span></td>
      </tr>
      <tr>
        <td style="font-weight: bold;">TERBILANG</td>
        <td style="font-style: italic;">{{ Str::title(Terbilang::make($penghasilanBersih, ' rupiah')) }}</td>
      </tr>
    </table>

    <h3>DITRANSFER KE</h3>
    <hr>
    <table width="100%">
      <tr>
        <td style="font-weight: bold;">BANK</td>
        <td>{{ $slipGaji->karyawan->bank->nama_bank }}</td>
      </tr>
      <tr>
        <td style="font-weight: bold;">ATAS NAMA</td>
        <td>{{ $slipGaji->karyawan->atas_nama_rekening }}</td>
      </tr>
      <tr>
        <td style="font-weight: bold;">NOMOR REKENING</td>
        <td>{{ $slipGaji->karyawan->nomor_rekening }}</td>
      </tr>
    </table>
</body>
</html>