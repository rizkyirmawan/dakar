@extends('auth.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-xl-10 col-lg-12 col-md-9">

    <a href="{{ route('auth.index') }}" class="btn btn-dark btn-sm btn-icon-split mt-3 shadow-sm">
      <span class="icon text-white-50">
        <i class="fas fa-arrow-circle-left"></i>
      </span>
      <span class="text">Kembali</span>
    </a>

    <div class="card border-0 shadow-lg my-3">
      <div class="card-header">
        <h5 class="text-primary">Registrasi Karyawan</h5>
      </div>
      <form action="{{ route('karyawan.register') }}" method="post" enctype="multipart/form-data">
        <div class="card-body p-4">

          <div class="form-row">

            @csrf

            <input type="hidden" name="role" value="CO">

            <div class="col-md-3 mb-3">
              <label for="nik" class="text-dark">NIK<span class="text-danger">*</span></label>
              <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" required>
              @error('nik')
                <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-5 mb-3">
              <label for="nama" class="text-dark">Nama<span class="text-danger">*</span></label>
              <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
              @error('nama')
                <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-4 mb-3">
              <label for="nomor_telepon" class="text-dark">Nomor Telepon<span class="text-danger">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">+62</span>
                </div>
                <input type="text" name="nomor_telepon" 
                class="form-control @error('nomor_telepon') is-invalid @enderror" maxlength="11" onkeypress="isNumber(event)" value="{{ old('nomor_telepon') }}" required>
              </div>
              @error('nomor_telepon')
                <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label for="alamat" class="text-dark">Alamat<span class="text-danger">*</span></label>
              <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}" required>
              @error('alamat')
                <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-3 mb-3">
              <label for="status_nikah" class="text-dark">Status Nikah<span class="text-danger">*</span></label>
              <select name="status_nikah" class="form-control @error('status_nikah') is-invalid @enderror" required>
                <option disabled selected>Status Nikah</option>
                <option value="Menikah" @if(old('status_nikah') == 'Menikah') {{ 'selected' }} @endif>Menikah</option>
                <option value="Belum Menikah" @if(old('status_nikah') == 'Belum Menikah') {{ 'selected' }} @endif>Belum Menikah</option>
              </select>
              @error('status_nikah')
                <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-3 mb-3">
              <label for="pendidikan" class="text-dark">Pendidikan<span class="text-danger">*</span></label>
              <select name="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror" required>
                <option disabled selected>Pilih Pendidikan</option>
                <option value="S3" @if(old('pendidikan') == 'S3') {{ 'selected' }} @endif>S3</option>
                <option value="S2" @if(old('pendidikan') == 'S2') {{ 'selected' }} @endif>S2</option>
                <option value="S1" @if(old('pendidikan') == 'S1') {{ 'selected' }} @endif>S1</option>
                <option value="D3" @if(old('pendidikan') == 'D3') {{ 'selected' }} @endif>D3</option>
                <option value="SMA" @if(old('pendidikan') == 'SMA') {{ 'selected' }} @endif>SMA</option>
                <option value="SMP" @if(old('pendidikan') == 'SMP') {{ 'selected' }} @endif>SMP</option>
                <option value="SD" @if(old('pendidikan') == 'SD') {{ 'selected' }} @endif>SD</option>
              </select>
              @error('pendidikan')
                <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-4 mb-3">
              <label for="tanggal_masuk" class="text-dark">Tanggal Masuk<span class="text-danger">*</span></label>
              <input type="date" name="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk') }}" required>
              @error('tanggal_masuk')
                <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-4 mb-3">
              <label for="bagian_id" class="text-dark">Bagian<span class="text-danger">*</span></label>
              <select name="bagian_id" class="form-control @error('bagian_id') is-invalid @enderror" required>
                <option disabled selected>Pilih Bagian</option>
                @foreach($bagian as $jabatan)
                  <option value="{{ $jabatan->id }}" @if(old('bagian_id') == $jabatan->id) {{ 'selected' }} @endif>{{ $jabatan->nama_bagian }}</option>
                @endforeach
              </select>
              @error('bagian_id')
                <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-4 mb-3">
              <label for="bank_id" class="text-dark">Bank<span class="text-danger">*</span></label>
              <select name="bank_id" class="form-control @error('bank_id') is-invalid @enderror" required>
                <option disabled selected>Pilih Bank</option>
                @foreach($banks as $bank)
                  <option value="{{ $bank->id }}" @if(old('bank_id') == $bank->id) {{ 'selected' }} @endif>{{ $bank->nama_bank }}</option>
                @endforeach
              </select>
              @error('bank_id')
                <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-3 mb-3">
              <label for="atas_nama_rekening" class="text-dark">Atas Nama Rekening<span class="text-danger">*</span></label>
              <input type="text" name="atas_nama_rekening" class="form-control @error('atas_nama_rekening') is-invalid @enderror" value="{{ old('atas_nama_rekening') }}">
              @error('atas_nama_rekening')
                <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-3 mb-3">
              <label for="nomor_rekening" class="text-dark">Nomor Rekening<span class="text-danger">*</span></label>
              <input type="text" name="nomor_rekening" class="form-control @error('nomor_rekening') is-invalid @enderror" onkeypress="isNumber(event)" maxlength="25" value="{{ old('nomor_rekening') }}" required>
              @error('nomor_rekening')
                <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-3 mb-3">
              <label for="status_pekerja" class="text-dark">Status Pekerja<span class="text-danger">*</span></label>
              <select name="status_pekerja" class="form-control @error('status_pekerja') is-invalid @enderror">
                <option disabled selected>Pilih Status Pekerja</option>
                <option value="Tetap" @if(old('status_pekerja') == 'Tetap') {{ 'selected' }} @endif>Tetap</option>
                <option value="Kontrak" @if(old('status_pekerja') == 'Kontrak') {{ 'selected' }} @endif>Kontrak</option>
              </select>
              @error('status_pekerja')
                <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-3 mb-3">
              <label for="foto" class="text-dark">Foto</label>
              <input type="file" name="foto" class="form-control-file @error('foto') is-invalid @enderror">
              @error('foto')
                <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>

          </div>

        </div>
        <div class="card-footer">
          <div class="text-right">
            <button type="submit" class="btn btn-primary btn-sm btn-icon-split">
              <span class="icon text-white-50">
                <i class="fas fa-check"></i>
              </span>
              <span class="text">Registrasi</span>
            </button>
          </div>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection