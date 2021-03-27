@extends('app')

@section('content')
  <h1 class="h3 mb-2 text-gray-800">Data Slip Gaji Karyawan</h1>
  <hr>

  @include('partials._messages')

  <div class="card shadow mb-4">
    <div class="card-header py-3">
    	<div class="d-flex">
    		<div class="p-2">
    			<h6 class="font-weight-bold text-primary">Data Slip Gaji Karyawan</h6>
    		</div>
    	</div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No.</th>
              <th>NIK</th>
              <th>Nama</th>
              <th>Periode</th>
              <th>Penghasilan Bersih</th>
              <th>Detail</th>
            </tr>
          </thead>
          <tbody>

            @foreach($payroll as $slipGaji)
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
            	<td>{{ $loop->iteration }}.</td>
              <td>{{ $slipGaji->karyawan->nik }}</td>
              <td>{{ Str::upper($slipGaji->karyawan->nama) }}</td>
              <td>{{ \Carbon\Carbon::parse($slipGaji->periode)->translatedFormat('F Y') }}</td>
              <td>Rp. {{ strrev(implode('.', str_split(strrev(strval($penghasilanBersih)), 3))) }}</td>
              <td>
                <a href="#detail-slip-gaji-{{ $slipGaji->id }}" data-toggle="modal" class="btn btn-info btn-sm btn-icon-split">
                  <span class="icon text-white-50">
                    <i class="fas fa-eye text-white-50"></i>
                  </span>
                  <span class="text">Detail</span>
                </a>

                @include('partials.modals.slipGaji.detailSlipGajiKaryawan')
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
