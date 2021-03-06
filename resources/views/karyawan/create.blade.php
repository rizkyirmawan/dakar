@extends('app')

@section('content')
	<h1 class="h3 mb-2 text-gray-800">Tambah Data Karyawan</h1>
  <hr>
	
	<a href="{{ route('karyawan.index') }}" class="btn btn-secondary btn-sm btn-icon-split mb-3">
    <span class="icon text-white-50">
      <i class="fas fa-arrow-left"></i>
    </span>
    <span class="text">Daftar Karyawan</span>
  </a>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data</h6>
    </div>
    <form action="{{ route('karyawan.store') }}" method="post" enctype="multipart/form-data">

		@csrf

	    @include('karyawan.form')

	    <div class="card-footer">
	    	<div class="d-flex justify-content-end">
	    		<button class="btn btn-primary btn-icon-split" type="submit">
	    			<span class="icon text-white-50">
	    				<i class="fas fa-save"></i>
	    			</span>
	    			<span class="text">Simpan</span>
	    		</button>
	    	</div>
	    </div>

    </form>
  </div>
@endsection

@section('scripts')
  <script src="{{ asset('js/app.js') }}"></script>
@endsection