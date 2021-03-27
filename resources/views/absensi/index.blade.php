@extends('app')

@section('content')
  <h1 class="h3 mb-2 text-gray-800">Data Absensi Karyawan: {{ today()->translatedFormat('d F Y') }}</h1>
  <hr>

  @include('partials._messages')

  <div class="card shadow mb-4">
    <div class="card-header py-3">
    	<div class="d-flex">
    		<div class="p-2">
    			<h6 class="font-weight-bold text-primary">Daftar Absensi Karyawan</h6>
    		</div>
    		<div class="p-2 ml-auto">
	      	<a href="#validasi-all-modal" data-toggle="modal" class="btn btn-success btn-sm btn-icon-split @if($absensiBelumValid <= 0) disabled @endif">
            <span class="icon text-white-50">
              <i class="fas fa-check"></i>
            </span>
            <span class="text">Validasi Semua</span>
          </a>
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
              <th>Waktu</th>
              <th>Status</th>
              <th>Kelola</th>
            </tr>
          </thead>
          <tbody>

            @foreach($absensiToday as $absen)
            <tr>
            	<td>{{ $loop->iteration }}.</td>
              <td>{{ $absen->karyawan->nik }}</td>
              <td>{{ $absen->karyawan->nama }}</td>
              <td>{{ \Carbon\Carbon::parse($absen->created_at)->diffForHumans() }}</td>
              <td>
                @if($absen->status == 0)
                  <span class="badge badge-secondary">Belum Tervalidasi</span>
                @else
                  <span class="badge badge-success">Valid</span>
                @endif
              </td>
              <td>
								<a href="#validasi-modal-{{ $absen->id }}" data-toggle="modal" class="btn btn-success btn-sm btn-icon-split @if($absen->status != 0) disabled @endif">
                  <span class="icon text-white-50">
                    <i class="fas fa-check text-white-50"></i>
                  </span>
                  <span class="text">Validasi</span>
                </a>

              @include('partials.modals.absensi.validasi')

              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>

  @include('partials.modals.absensi.validasiAll')
@endsection
