@extends('app')

@section('content')
  <h1 class="h3 mb-2 text-gray-800">Laporan Absensi Karyawan: {{ today()->translatedFormat('F Y') }}</h1>
  <hr>

  @include('partials._messages')

  <div class="row">
    <div class="col-md-3">
      <form action="{{ route('absensi.export') }}" method="post">
        @csrf
        <label for="filter" class="text-dark">Filter Periode:</label>
        <div class="input-group mb-2">
          <select name="filter" class="form-control" required>
            <option disabled selected>Pilih Periode</option>
            <option value="Mingguan">Mingguan</option>
            <option value="Bulanan">Bulanan</option>
            <option value="Tahunan">Tahunan</option>
          </select>
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
    			<h6 class="font-weight-bold text-primary">Laporan Absensi Karyawan</h6>
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
              <th>Jumlah Absen</th>
            </tr>
          </thead>
          <tbody>

            @foreach($karyawanWithAbsensi->where('user.role', 'CO') as $karyawan)
            <tr>
            	<td>{{ $loop->iteration }}.</td>
              <td>{{ $karyawan->nik }}</td>
              <td>{{ $karyawan->nama }}</td>
              <td>{{ $karyawan->absensi->where('status', 1)->count() > 0 ? $karyawan->absensi->where('status', 1)->count() : 'Belum Ada' }}</td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>

  @include('partials.modals.absensi.validasiAll')
@endsection
