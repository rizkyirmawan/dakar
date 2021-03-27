@extends('app')

@section('content')
  <h1 class="h3 mb-2 text-gray-800">Laporan Data Karyawan</h1>
  <hr>

  @include('partials._messages')

  <div class="mb-3">
    <a href="#export-collapse" data-toggle="collapse" class="btn btn-success btn-sm btn-icon-split @if($employee->count() <= 0) disabled @endif">
      <span class="icon text-white-50">
        <i class="fas fa-file-export"></i>
      </span>
      <span class="text">Export Excel</span>
    </a>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="collapse" id="export-collapse">
        <div class="card card-body mb-3">
          <form action="{{ route('karyawan.export') }}" method="post">
            @csrf
            <div class="form-row">

              <div class="col-md-4">
                <label for="filter-select" class="text-dark">Filter:</label>
                <select name="filter" class="form-control" id="filter-select" required>
                  <option disabled selected>Filter Berdasarkan</option>
                  <option value="TM">Tanggal Masuk</option>
                  <option value="ST">Status</option>
                </select>
              </div>

              <div class="col-md-4 d-none" id="tanggal-awal-div">
                <label for="tanggal_awal" class="text-dark">Dari:</label>
                <input type="date" name="tanggal_awal" id="tanggal-awal-input" class="form-control" max="{{ today() }}">
              </div>

              <div class="col-md-4 d-none" id="tanggal-akhir-div">
                <label for="tanggal_akhir" class="text-dark">Sampai:</label>
                <input type="date" name="tanggal_akhir" id="tanggal-akhir-input" class="form-control" max="{{ today() }}">
              </div>

              <div class="col-md-8 d-none" id="status-div">
                <label for="status" class="text-dark">Status:</label>
                <select class="form-control" name="status" id="status-select">
                  <option disabled selected>Pilih Status</option>
                  <option value="1">Aktif</option>
                  <option value="0">Non Aktif</option>
                </select>
              </div>

            </div>
            <button class="btn btn-sm btn-success mt-3" type="submit">Export</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
    	<div class="d-flex">
    		<div class="p-2">
    			<h6 class="font-weight-bold text-primary">Laporan Data Karyawan</h6>
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
              <th>Tanggal Masuk</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>

            @foreach($employee as $karyawan)
            <tr>
            	<td>{{ $loop->iteration }}.</td>
              <td>{{ $karyawan->nik }}</td>
              <td>{{ $karyawan->nama }}</td>
              <td>{{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->translatedFormat('d F Y') }}</td>
              <td>
                @if($karyawan->status == 1)
                  <span class="badge badge-success">Aktif</span>
                @elseif($karyawan->status == 0)
                  <span class="badge badge-danger">Non Aktif</span>
                @endif
              </td>
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    const filterSelect = document.querySelector('#filter-select');
    const tanggalAwal = document.querySelector('#tanggal-awal');
    const tanggalAkhir = document.querySelector('#tanggal-akhir');
    const tanggalAwalInput = document.querySelector('#tanggal-awal-input');
    const tanggalAkhirInput = document.querySelector('#tanggal-akhir-input');
    const statusSelect = document.querySelector('#status-select');
    const tanggalAwalDiv = document.querySelector('#tanggal-awal-div');
    const tanggalAkhirDiv = document.querySelector('#tanggal-akhir-div');
    const statusDiv = document.querySelector('#status-div');

    filterSelect.addEventListener('change', function() {
      switch(this.value) {
        case 'TM':
          tanggalAwalDiv.classList.remove('d-none');
          tanggalAkhirDiv.classList.remove('d-none');
          statusDiv.classList.add('d-none');
          statusSelect.selectedIndex = 0;
          break;
        case 'ST':
          statusDiv.classList.remove('d-none');
          tanggalAwalDiv.classList.add('d-none');
          tanggalAkhirDiv.classList.add('d-none');
          tanggalAwalInput.value = null;
          tanggalAkhirInput.value = null;
          break;
        default:
          break;
      }
    });

    tanggalAwalInput.addEventListener('change', function() {
      tanggalAkhirInput.setAttribute('min', this.value);
    });
  </script>
@endsection