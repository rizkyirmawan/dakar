@extends('app')

@section('content')
  <h1 class="h3 mb-2 text-gray-800">Laporan Slip Gaji Karyawan</h1>
  <hr>

  @include('partials._messages')

  <div class="row">
    <div class="col-md-3">
      <form action="{{ route('slipGaji.exportSlipGajiByPeriode') }}" method="post">
        @csrf
        <label for="periode" class="text-dark">Periode:</label>
        <div class="input-group mb-2">
          <input type="month" class="form-control" name="periode" class="form-control" value="{{ request()->periode ? \Carbon\Carbon::parse(request()->periode)->format('Y-m') : today()->format('Y-m') }}" max="{{ today()->format('Y-m') }}" required>
          <div class="input-group-append">
            <button type="submit" class="btn btn-outline-info" type="button">Export</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
    	<div class="d-flex">
    		<div class="p-2">
    			<h6 class="font-weight-bold text-primary">Laporan Slip Gaji Karyawan</h6>
    		</div>
    		<div class="p-2 ml-auto">
	      	<h6 class="text-dark">Periode: {{ request()->periode ? \Carbon\Carbon::parse(request()->periode)->translatedFormat('F Y') : today()->translatedFormat('F Y') }}</h6>
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
              <th>Total Pendapatan</th>
              <th>Total Pengurangan</th>
              <th>Penghasilan Bersih</th>
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
            	<td>{{ $loop->iteration }}.</td>
              <td>{{ $slipGaji->karyawan->nik }}</td>
              <td>{{ Str::upper($slipGaji->karyawan->nama) }}</td>
              <td>Rp. {{ strrev(implode('.', str_split(strrev(strval($totalPendapatan)), 3))) }}</td>
              <td>Rp. {{ strrev(implode('.', str_split(strrev(strval($totalPengurangan)), 3))) }}</td>
              <td>Rp. {{ strrev(implode('.', str_split(strrev(strval($penghasilanBersih)), 3))) }}</td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
