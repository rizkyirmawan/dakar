@extends('app')

@section('content')
  <h1 class="h3 mb-2 text-gray-800">Data Bagian</h1>
  <hr>

  @include('partials._messages')

  <div class="card shadow mb-4">
    <div class="card-header py-3">
    	<div class="d-flex">
    		<div class="p-2">
    			<h6 class="font-weight-bold text-primary">Daftar Bagian</h6>
    		</div>
    		<div class="p-2 ml-auto">
	      	<a href="#create-bagian" class="btn btn-primary btn-sm btn-icon-split" data-toggle="modal">
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
              <th>Bagian</th>
              <th>Gaji Pokok</th>
              <th>Kelola</th>
            </tr>
          </thead>
          <tbody>

            @foreach($bagian as $jabatan)
            <tr>
            	<td>{{ $loop->iteration }}.</td>
              <td>{{ $jabatan->nama_bagian }}</td>
              <td>{{ 'Rp. ' . strrev(implode('.', str_split(strrev(strval($jabatan->gaji_pokok)), 3))) }}</td>
              <td>
                <div class="dropdown">
  								<button class="btn btn-secondary btn-sm btn-icon-split" data-toggle="dropdown">
                    <span class="icon text-white-50">
                      <i class="fas fa-cog text-white-50"></i>
                    </span>
                    <span class="text">Kelola</span>
                  </button>
                  <div class="dropdown-menu shadow animated--grow-in" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#edit-modal-{{ $jabatan->id }}" data-toggle="modal">
                      <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                      Edit
                    </a>
                    <a class="dropdown-item" href="#delete-modal-{{ $jabatan->id }}" data-toggle="modal">
                      <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                      Hapus
                    </a>
                  </div>
                </div>
              </td>
            </tr>

            @include('partials.modals.bagian.editBagian')
            @include('partials.modals.bagian.deleteBagian')
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>

  @include('partials.modals.bagian.createBagian')
@endsection

@section('scripts')
  <script src="{{ asset('js/app.js') }}"></script>
@endsection
