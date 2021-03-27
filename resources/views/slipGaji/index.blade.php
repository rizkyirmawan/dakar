@extends('app')

@section('content')
  <h1 class="h3 mb-2 text-gray-800">Data Slip Gaji Karyawan</h1>
  <hr>

  @include('partials._messages')

  <div class="row">
    <div class="col-md-3">
      <form action="{{ route('slipGaji.index') }}">
        <label for="periode" class="text-dark">Periode:</label>
        <div class="input-group mb-2">
          <input type="month" class="form-control" name="periode" class="form-control" value="{{ request()->periode ? \Carbon\Carbon::parse(request()->periode)->format('Y-m') : today()->format('Y-m') }}" max="{{ today()->format('Y-m') }}" required>
          <div class="input-group-append">
            <button type="submit" class="btn btn-outline-info" type="button">Filter</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
    	<div class="d-flex">
    		<div class="p-2">
    			<h6 class="font-weight-bold text-primary">Daftar Slip Gaji Karyawan</h6>
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
              <th>Bagian</th>
              <th>Slip Gaji</th>
              <th>Kelola</th>
            </tr>
          </thead>
          <tbody>

            @foreach($karyawanWithSlipGaji->where('user.role', 'CO') as $karyawan)
            <tr>
            	<td>{{ $loop->iteration }}.</td>
              <td>{{ $karyawan->nik }}</td>
              <td>{{ Str::upper($karyawan->nama) }}</td>
              <td>{{ 'MMS ' . Str::upper($karyawan->bagian->nama_bagian) }}</td>
              <td>
                @if($karyawan->slipGaji->count() <= 0)
                  <span class="badge badge-secondary">Belum Dibuat</span>
                @else
                  <span class="badge badge-success">Sudah Dibuat</span>
                @endif
              </td>
              <td>
                @if($karyawan->slipGaji->count() <= 0)
                  <a href="#create-slip-gaji-{{ $karyawan->id }}" data-toggle="modal" class="btn btn-success btn-sm btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-edit text-white-50"></i>
                    </span>
                    <span class="text">Buat Slip Gaji</span>
                  </a>

                  @include('partials.modals.slipGaji.createSlipGaji')

                @else 
                  <a href="#detail-slip-gaji-{{ $karyawan->slipGaji[0]['id'] }}" data-toggle="modal" class="btn btn-info btn-sm btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-eye text-white-50"></i>
                    </span>
                    <span class="text">Detail Slip Gaji</span>
                  </a>

                  @include('partials.modals.slipGaji.detailSlipGaji')

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
  <script src="{{ asset('js/app.js') }}"></script>
@endsection
