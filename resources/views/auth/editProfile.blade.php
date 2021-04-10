@extends('app')

@section('content')
	<h1 class="h3 mb-2 text-gray-800">Update Profil</h1>
    <hr>

  	@include('partials._messages')
	
	<a href="{{ route('dasbor.index') }}" class="btn btn-secondary btn-sm btn-icon-split mb-3">
    <span class="icon text-white-50">
      <i class="fas fa-arrow-left"></i>
    </span>
    <span class="text">Dasbor</span>
  </a>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Form Update Profil</h6>
    </div>
    <form action="{{ route('karyawan.updateProfile', ['karyawan' => $karyawan->id]) }}" method="post" enctype="multipart/form-data">

    	@method('patch')

		@csrf

	    <div class="card-body">

			<div class="form-row">

				<div class="col-md-3 mb-3">
					<label for="nik" class="text-dark">NIK:</label>
					<input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" onkeypress="isNumber(event)" value="{{ old('nik') ?? $karyawan->nik }}" readonly>
					@error('nik')
						<small class="form-text text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-md-5 mb-3">
					<label for="nama" class="text-dark">Nama:</label>
					<input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') ?? $karyawan->nama }}">
					@error('nama')
						<small class="form-text text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-md-4 mb-3">
					<label for="nomor_telepon" class="text-dark">Nomor Telepon:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">+62</span>
						</div>
						<input type="text" name="nomor_telepon" 
						class="form-control @error('nomor_telepon') is-invalid @enderror" maxlength="11" onkeypress="isNumber(event)" value="{{ old('nomor_telepon') ?? Str::substr($karyawan->nomor_telepon, 3) }}">
					</div>
					@error('nomor_telepon')
						<small class="form-text text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-md-6 mb-3">
					<label for="alamat" class="text-dark">Alamat:</label>
					<input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') ?? $karyawan->alamat }}">
					@error('alamat')
						<small class="form-text text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-md-3 mb-3">
					<label for="status_nikah" class="text-dark">Status Nikah:</label>
					<select name="status_nikah" class="form-control @error('status_nikah') is-invalid @enderror">
						<option disabled selected>Status Nikah</option>
						<option value="Menikah" @if($karyawan->status_nikah == 'Menikah' || old('status_nikah') == 'Menikah') {{ 'selected' }} @endif>Menikah</option>
						<option value="Belum Menikah" @if($karyawan->status_nikah == 'Belum Menikah' || old('status_nikah') == 'Belum Menikah') {{ 'selected' }} @endif>Belum Menikah</option>
					</select>
					@error('status_nikah')
						<small class="form-text text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-md-3 mb-3">
					<label for="pendidikan" class="text-dark">Pendidikan:</label>
					<select name="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror">
						<option disabled selected>Pilih Pendidikan</option>
						<option value="S3" @if($karyawan->pendidikan == 'S3' || old('pendidikan') == 'S3') {{ 'selected' }} @endif>S3</option>
						<option value="S2" @if($karyawan->pendidikan == 'S2' || old('pendidikan') == 'S2') {{ 'selected' }} @endif>S2</option>
						<option value="S1" @if($karyawan->pendidikan == 'S1' || old('pendidikan') == 'S1') {{ 'selected' }} @endif>S1</option>
						<option value="D3" @if($karyawan->pendidikan == 'D3' || old('pendidikan') == 'D3') {{ 'selected' }} @endif>D3</option>
						<option value="SMA" @if($karyawan->pendidikan == 'SMA' || old('pendidikan') == 'SMA') {{ 'selected' }} @endif>SMA</option>
						<option value="SMP" @if($karyawan->pendidikan == 'SMP' || old('pendidikan') == 'SMP') {{ 'selected' }} @endif>SMP</option>
						<option value="SD" @if($karyawan->pendidikan == 'SD' || old('pendidikan') == 'SD') {{ 'selected' }} @endif>SD</option>
					</select>
					@error('pendidikan')
						<small class="form-text text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-md-3 mb-3">
					<label for="tanggal_masuk" class="text-dark">Tanggal Masuk:</label>
					<input type="date" name="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk') ?? $karyawan->tanggal_masuk }}" readonly>
					@error('tanggal_masuk')
						<small class="form-text text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-md-3 mb-3">
					<label for="role" class="text-dark">Jabatan:</label>
					<input type="text" name="role" class="form-control" value="{{ $karyawan->user->role }}" readonly>
					@error('role')
						<small class="form-text text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-md-3 mb-3">
					<label for="bagian_id" class="text-dark">Bagian:</label>
					<select name="bagian_id" class="form-control @error('bagian_id') is-invalid @enderror" id="bagian-select" readonly>
						<option disabled selected>Pilih Bagian</option>
						@foreach($bagian as $jabatan)
							<option value="{{ $jabatan->id }}" @if($karyawan->bagian_id == $jabatan->id || old('bagian_id') == $jabatan->id) {{ 'selected' }} @endif>{{ $jabatan->nama_bagian }}</option>
						@endforeach
					</select>
					@error('bagian_id')
						<small class="form-text text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-md-3 mb-3">
					<label for="bank_id" class="text-dark">Bank:</label>
					<select name="bank_id" class="form-control @error('bank_id') is-invalid @enderror">
						<option disabled selected>Pilih Bank</option>
						@foreach($banks as $bank)
							<option value="{{ $bank->id }}" @if($karyawan->bank_id == $bank->id || old('bank_id') == $bank->id) {{ 'selected' }} @endif>{{ $bank->nama_bank }}</option>
						@endforeach
					</select>
					@error('bank_id')
						<small class="form-text text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-md-3 mb-3">
					<label for="atas_nama_rekening" class="text-dark">Atas Nama Rekening:</label>
					<input type="text" name="atas_nama_rekening" class="form-control @error('atas_nama_rekening') is-invalid @enderror" value="{{ old('atas_nama_rekening') ?? $karyawan->atas_nama_rekening }}">
					@error('atas_nama_rekening')
						<small class="form-text text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-md-3 mb-3">
					<label for="nomor_rekening" class="text-dark">Nomor Rekening:</label>
					<input type="text" name="nomor_rekening" class="form-control @error('nomor_rekening') is-invalid @enderror" onkeypress="isNumber(event)" maxlength="25" value="{{ old('nomor_rekening') ?? $karyawan->nomor_rekening }}">
					@error('nomor_rekening')
						<small class="form-text text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-md-3 mb-3">
					<label for="status_pekerja" class="text-dark">Status Pekerja:</label>
					<input type="text" name="status_pekerja" class="form-control" value="{{ $karyawan->status_pekerja }}" readonly>
					@error('status_pekerja')
						<small class="form-text text-danger">{{ $message }}</small>
					@enderror
				</div>

				<div class="col-md-3 mb-3">
					<label for="foto" class="text-dark">Foto:</label>
					<input type="file" name="foto" class="form-control-file @error('foto') is-invalid @enderror" value="{{ old('foto') ?? $karyawan->foto }}">
					@error('foto')
						<small class="form-text text-danger">{{ $message }}</small>
					@enderror
				</div>

			</div>

		</div>

	    <div class="card-footer">
	    	<div class="d-flex justify-content-end">
	    		<button class="btn btn-primary btn-icon-split" type="submit">
	    			<span class="icon text-white-50">
	    				<i class="fas fa-save"></i>
	    			</span>
	    			<span class="text">Simpan Perubahan</span>
	    		</button>
	    	</div>
	    </div>

    </form>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/app.js') }}"></script>
@endsection