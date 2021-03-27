@extends('app')

@section('content')
  <h1 class="h3 mb-2 text-gray-800">Detail Karyawan</h1>
  <hr>

  @include('partials._messages')

  <div class="d-flex mb-2">
    <div class="mr-auto p-2">
      <a href="{{ route('karyawan.index') }}" class="btn btn-dark btn-sm btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-arrow-left"></i>
        </span>
        <span class="text">Kembali</span>
      </a>
    </div>
    @if($karyawan->status == 1)
    <div class="p-2">
      <form action="{{ route('karyawan.nonaktif', ['karyawan' => $karyawan]) }}" method="post">
        @method('patch')
        @csrf
        <button type="submit" class="btn btn-secondary btn-sm btn-icon-split">
          <span class="icon text-white-50">
            <i class="fas fa-user-times"></i>
          </span>
          <span class="text">Nonaktifkan</span>
        </button>
      </form>
    </div>
    @elseif($karyawan->status == 0)
    <div class="p-2">
      <form action="{{ route('karyawan.validasi', ['karyawan' => $karyawan]) }}" method="post">
        @method('patch')
        @csrf
        <button type="submit" class="btn btn-warning btn-sm btn-icon-split">
          <span class="icon text-white-50">
            <i class="fas fa-user-check"></i>
          </span>
          <span class="text">Aktifkan</span>
        </button>
      </form>
    </div>
    @endif
    <div class="p-2">
      <a href="{{ route('karyawan.edit', ['karyawan' => $karyawan]) }}" class="btn btn-success btn-sm btn-icon-split">
        <span class="icon text-white-50">
          <i class="fas fa-edit"></i>
        </span>
        <span class="text">Ubah</span>
      </a>
    </div>
    <div class="p-2">
      <a href="#" class="btn btn-danger btn-sm btn-icon-split" data-target="#delete-karyawan-{{ $karyawan->id }}" data-toggle="modal">
        <span class="icon text-white-50">
          <i class="fas fa-trash"></i>
        </span>
        <span class="text">Hapus</span>
      </a>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
			<h6 class="font-weight-bold text-primary">Detail dari {{ $karyawan->nama }}</h6>
    </div>
    <div class="card-body">
      <div class="row">

        @if($karyawan->foto)
          <div class="col-md-6 text-center">
            <img src="{{ asset('storage/' . $karyawan->foto) }}" class="img-fluid img-thumbnail rounded" width="295">
          </div>
        @else
          <div class="col-md-6 text-center">
            <img src="{{ asset('img/undraw_profile.svg') }}" class="img-fluid img-thumbnail rounded" width="295">
          </div>
        @endif

        <div class="col-md-6">

          <button class="btn btn-outline-secondary btn-block mt-2" type="button" data-toggle="collapse" data-target="#collapseBiodata">
            Biodata
          </button>
          <div class="collapse mt-2 animated--fade-in show" id="collapseBiodata">
            <div class="card card-body">
              <table class="table table-bordered text-dark">
                <tr>
                  <td class="text-dark font-weight-bold">NIK</td>
                  <td>{{ $karyawan->nik }}</td>
                </tr>
                <tr>
                  <td class="text-dark font-weight-bold">Nama</td>
                  <td>{{ $karyawan->nama }}</td>
                </tr>
                <tr>
                  <td class="text-dark font-weight-bold">Alamat</td>
                  <td>{{ $karyawan->alamat }}</td>
                </tr>
                <tr>
                  <td class="text-dark font-weight-bold">Nomor Telepon</td>
                  <td>{{ $karyawan->nomor_telepon }}</td>
                </tr>
                <tr>
                  <td class="text-dark font-weight-bold">Status Pernikahan</td>
                  <td>{{ $karyawan->status_nikah }}</td>
                </tr>
                <tr>
                  <td class="text-dark font-weight-bold">Pendidikan Terakhir</td>
                  <td>{{ $karyawan->pendidikan }}</td>
                </tr>
                <tr>
                  <td class="text-dark font-weight-bold">Jabatan</td>
                  <td>
                    @if($karyawan->user->role == 'CO')
                      Community Officer
                    @elseif($karyawan->user->role == 'SO')
                      Senior Officer
                    @elseif($karyawan->user->role == 'BM')
                      Business Manager
                    @endif
                  </td>
                </tr>
              </table>
            </div>
          </div>

          <button class="btn btn-outline-secondary btn-block mt-2" type="button" data-toggle="collapse" data-target="#collapseBank">
            Informasi Bank
          </button>
          <div class="collapse mt-2 animated--fade-in" id="collapseBank">
            <div class="card card-body">
              <table class="table table-bordered text-dark">
                <tr>
                  <td class="text-dark font-weight-bold">Kode Bank</td>
                  <td>{{ $karyawan->bank->kode_bank }}</td>
                </tr>
                <tr>
                  <td class="text-dark font-weight-bold">Nama Bank</td>
                  <td>{{ $karyawan->bank->nama_bank }}</td>
                </tr>
                <tr>
                  <td class="text-dark font-weight-bold">Atas Nama Rekening</td>
                  <td>{{ $karyawan->atas_nama_rekening }}</td>
                </tr>
                <tr>
                  <td class="text-dark font-weight-bold">Nomor Rekening</td>
                  <td>{{ $karyawan->nomor_rekening }}</td>
                </tr>
              </table>
            </div>
          </div>

          <button class="btn btn-outline-secondary btn-block mt-2" type="button" data-toggle="collapse" data-target="#collapseBagian">
            Informasi Bagian
          </button>
          <div class="collapse mt-2 animated--fade-in" id="collapseBagian">
            <div class="card card-body">
              <table class="table table-bordered text-dark">
                <tr>
                  <td class="text-dark font-weight-bold">Bagian (Daerah)</td>
                  <td>{{ $karyawan->bagian->nama_bagian }}</td>
                </tr>
                <tr>
                  <td class="text-dark font-weight-bold">Gaji Pokok</td>
                  <td>{{ 'Rp. ' . strrev(implode('.', str_split(strrev(strval($karyawan->bagian->gaji_pokok)), 3))) }}</td>
                </tr>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  @include('partials.modals.karyawan.deleteKaryawan')

@endsection
