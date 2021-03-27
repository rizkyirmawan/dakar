@extends('app')

@section('content')
  <h1 class="h3 mb-2 text-gray-800">Data Karyawan</h1>
  <hr>

  @include('partials._messages')

  <div class="card shadow mb-4">
    <div class="card-header py-3">
    	<div class="d-flex">
    		<div class="p-2">
    			<h6 class="font-weight-bold text-primary">Daftar Karyawan</h6>
    		</div>
    		<div class="p-2 ml-auto">
	      	<a href="{{ route('karyawan.create') }}" class="btn btn-primary btn-sm btn-icon-split">
            <span class="icon text-white-50">
              <i class="fas fa-plus"></i>
            </span>
            <span class="text">Tambah Data</span>
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
              <th>Jabatan</th>
              <th>Status</th>
              <th>Kelola</th>
            </tr>
          </thead>
          <tbody>

            @foreach($employee as $karyawan)
            <tr>
            	<td>{{ $loop->iteration }}.</td>
              <td>{{ $karyawan->nik }}</td>
              <td>{{ $karyawan->nama }}</td>
              <td>
                @if($karyawan->user->role == 'CO')
                  Community Officer
                @elseif($karyawan->user->role == 'SO')
                  Senior Officer
                @elseif($karyawan->user->role == 'BM')
                  Business Manager
                @endif
              </td>
              <td>
                @if($karyawan->status == 1)
                  <span class="badge badge-success">Aktif</span>
                @elseif($karyawan->status == 0)
                  <span class="badge badge-danger">Non Aktif</span>
                @endif
              </td>
              <td>
                @if($karyawan->status == 1)
                  <a href="{{ route('karyawan.show', ['karyawan' => $karyawan]) }}" class="btn btn-secondary btn-sm btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-eye text-white-50"></i>
                    </span>
                    <span class="text">Detail</span>
                  </a>
                @elseif($karyawan->status == 0)
                  <a href="#validasi-{{ $karyawan->id }}" data-toggle="modal" class="btn btn-success btn-sm btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check text-white-50"></i>
                    </span>
                    <span class="text">Aktifkan</span>
                  </a>

                  @include('partials.modals.karyawan.validasi')
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
