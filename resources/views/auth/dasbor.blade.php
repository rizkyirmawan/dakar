@extends('app')

@section('content')
	<h2 class="text-dray-800">Dasbor</h2>

	<hr>

	@include('partials._messages')

	@if(auth()->user()->role == 'CO')
	<div class="d-flex justify-content-center">
		<div class="col-md-8">
			<div class="card card-body text-center">
				<h2 class="text-dark">{{ today()->translatedFormat('d F Y') }}</h2>
				@if($absenToday && $absenToday->status == 0)
					<h4><span class="badge badge-info">Menunggu Validasi</span></h4>
				@elseif($absenToday && $absenToday->status == 1)
					<h4><span class="badge badge-success">Sudah Absen</span></h4>
				@else
					<h4><span class="badge badge-secondary">Belum Absen</span></h4>
					<form action="{{ route('absensi.storeAbsen') }}" method="post">
						@csrf
			      		<button class="btn btn-success btn-icon-split" data-toggle="modal">
				            <span class="icon text-white-50">
				              <i class="fas fa-check"></i>
				            </span>
				            <span class="text">Cek Kehadiran</span>
				        </button>
					</form>
				@endif
			</div>
		</div>
	</div>
	@endif

	@if(auth()->user()->role == 'Admin' || auth()->user()->role == 'SO' || auth()->user()->role == 'BM')
	<div class="row">
		
		<div class="col-xl-4 col-md-6 mb-4">
	      <div class="card border-left-warning shadow h-100 py-2">
	        <div class="card-body">
	          <div class="row no-gutters align-items-center">
	            <div class="col mr-2">
	              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Karyawan</div>
	              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $karyawanAll }} Karyawan</div>
	            </div>
	            <div class="col-auto">
	              <i class="fas fa-user fa-2x text-gray-300"></i>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>

	    <div class="col-xl-4 col-md-6 mb-4">
	      <div class="card border-left-info shadow h-100 py-2">
	        <div class="card-body">
	          <div class="row no-gutters align-items-center">
	            <div class="col mr-2">
	              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Karyawan Aktif</div>
	              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $karyawanAktif }} Karyawan</div>
	            </div>
	            <div class="col-auto">
	              <i class="fas fa-user-check fa-2x text-gray-300"></i>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>

	    <div class="col-xl-4 col-md-6 mb-4">
	      <div class="card border-left-danger shadow h-100 py-2">
	        <div class="card-body">
	          <div class="row no-gutters align-items-center">
	            <div class="col mr-2">
	              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Karyawan Nonaktif</div>
	              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $karyawanTidakAktif }} Karyawan</div>
	            </div>
	            <div class="col-auto">
	              <i class="fas fa-user-times fa-2x text-gray-300"></i>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>

	</div>
	@endif
@endsection