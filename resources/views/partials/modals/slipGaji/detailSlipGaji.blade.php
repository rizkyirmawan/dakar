<div class="modal fade" id="detail-slip-gaji-{{ $karyawan->slipGaji[0]['id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Detail Slip Gaji</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <h5 class="text-dark">Informasi Karyawan</h5>
        <hr>
        <table class="table table-bordered">
          <tr>
            <td class="font-weight-bold">NAMA</td>
            <td>: {{ $karyawan->nama }}</td>
            <td class="font-weight-bold">POSISI</td>
            <td>: {{ ($karyawan->user->role == 'CO' ? 'COMMUNITY OFFICER' : '') }}</td>
          </tr>
          <tr>
            <td class="font-weight-bold">NIK</td>
            <td>: {{ $karyawan->nik }}</td>
            <td class="font-weight-bold">ORGANISASI</td>
            <td>: {{ 'MMS ' . Str::upper($karyawan->bagian->nama_bagian) }}</td>
          </tr>
          <tr>
            <td class="font-weight-bold">STATUS</td>
            <td>: {{ $karyawan->status_pekerja }}</td>
            <td class="font-weight-bold">LOKASI</td>
            <td>: {{ 'MMS ' . Str::upper($karyawan->bagian->nama_bagian) }}</td>
          </tr>
          <tr>
            <td class="font-weight-bold">TAX MARITAL</td>
            <td>: 50</td>
            <td class="font-weight-bold">GRADE</td>
            <td>: {{ $karyawan->user->role . $karyawan->slipGaji[0]['insentif_level'] . ': ' . ($karyawan->user->role == 'CO' ? 'COMMUNITY OFFICER' : '') . ' ' . $karyawan->slipGaji[0]['insentif_level'] }}</td>
          </tr>
        </table>

        @php
          $gajiPokok      = $karyawan->bagian->gaji_pokok;
          $insentifNetTur = $karyawan->slipGaji[0]['insentif_net_tur'];
          $tunjanganUmp   = $karyawan->slipGaji[0]['tunjangan_ump'];
          $fasilitasMMS   = $karyawan->slipGaji[0]['fasilitas_mms'];
          $bonusInsentif  = $karyawan->slipGaji[0]['bonus_insentif'];
          $tunjanganHPMMS = $karyawan->slipGaji[0]['tunjangan_hp_mms'];
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

        <h5 class="text-dark">Pendapatan</h5>
        <hr>
        <table class="table table-bordered">
          <tr>
            <td class="font-weight-bold">GAJI POKOK NET</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($gajiPokok)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">TUNJANGAN JHT 3.7%</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jhtTigaKomaTujuh)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">TUNJANGAN JKK 0.24%</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jkkNolKomaDuaEmpat)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">TUNJANGAN JKM 0.3%</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jkmNolKomaTiga)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">INSENTIF NET TUR</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($insentifNetTur)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">TUNJANGAN UMP</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($tunjanganUmp)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">TUNJANGAN BPJS PERUSAHAAN 4%</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($BPJSPerusahaan)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">INSENTIF LEVEL {{ $karyawan->slipGaji[0]['insentif_level'] }}</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($bonusInsentif)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">TUNJANGAN JP 2%</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jpDua)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">TUNJANGAN HP MMS</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($tunjanganHPMMS)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">FASILITAS MMS</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($fasilitasMMS)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">TOTAL PENDAPATAN</td>
            <td class="font-weight-bold">Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($totalPendapatan)), 3))) }}</span></td>
          </tr>
        </table>

        <h5 class="text-dark">Pengurangan</h5>
        <hr>
        <table class="table table-bordered">
          <tr>
            <td class="font-weight-bold">JHT PREMIUM 2%</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jhtDua)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">JHT PREMIUM 3.7%</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jhtTigaKomaTujuh)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">JKK PREMIUM 0.24%</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jkkNolKomaDuaEmpat)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">JKK PREMIUM 0.3%</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jkmNolKomaTiga)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">POT BPJS PERUSAHAAN 4%</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($BPJSPerusahaan)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">POT BPJS KARYAWAN</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($BPJSKaryawan)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">POT JP PREMIUM 2%</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jpDua)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">POT JP PREMIUM 1%</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($jpSatu)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">FASILITAS MMS</td>
            <td>Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($fasilitasMMS)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">TOTAL PENGURANGAN</td>
            <td class="font-weight-bold">Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($totalPengurangan)), 3))) }}</span></td>
          </tr>
        </table>

        <h5 class="text-dark">Penghasilan Bersih</h5>
        <hr>
        <table class="table table-bordered">
          <tr>
            <td class="font-weight-bold">PENGHASILAN BERSIH</td>
            <td class="font-weight-bold">Rp. <span style="float: right;">{{ strrev(implode('.', str_split(strrev(strval($penghasilanBersih)), 3))) }}</span></td>
          </tr>
          <tr>
            <td class="font-weight-bold">TERBILANG</td>
            <td class="font-italic">{{ Str::title(Terbilang::make($penghasilanBersih, ' rupiah')) }}</td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <a href="{{ route('slipGaji.export', ['id' => $karyawan->slipGaji[0]['id']]) }}" class="btn btn-success btn-icon-split">
          <span class="icon text-white-50">
            <i class="fas fa-file-export text-white-50"></i>
          </span>
          <span class="text">Export PDF</span>
        </a>
      </div>
    </div>
  </div>
</div>