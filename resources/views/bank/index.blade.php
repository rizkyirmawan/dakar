@extends('app')

@section('content')
  <h1 class="h3 mb-2 text-gray-800">Data Bank</h1>
  <hr>

  @include('partials._messages')

  <div class="card shadow mb-4">
    <div class="card-header py-3">
    	<div class="d-flex">
    		<div class="p-2">
    			<h6 class="font-weight-bold text-primary">Daftar Bank</h6>
    		</div>
    		<div class="p-2 ml-auto">
	      	<a href="#create-bank" class="btn btn-primary btn-sm btn-icon-split" data-toggle="modal">
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
              <th>Kode Bank</th>
              <th>Nama Bank</th>
              <th>Kelola</th>
            </tr>
          </thead>
          <tbody>

            @foreach($banks as $bank)
            <tr>
            	<td>{{ $loop->iteration }}.</td>
              <td>{{ $bank->kode_bank }}</td>
              <td>{{ $bank->nama_bank }}</td>
              <td>
                <div class="dropdown">
  								<button class="btn btn-secondary btn-sm btn-icon-split" data-toggle="dropdown">
                    <span class="icon text-white-50">
                      <i class="fas fa-cog text-white-50"></i>
                    </span>
                    <span class="text">Kelola</span>
                  </button>
                  <div class="dropdown-menu shadow animated--grow-in" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#edit-modal-{{ $bank->id }}" data-toggle="modal">
                      <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                      Edit
                    </a>
                    <a class="dropdown-item" href="#delete-modal-{{ $bank->id }}" data-toggle="modal">
                      <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                      Hapus
                    </a>
                  </div>
                </div>
              </td>
            </tr>

            @include('partials.modals.bank.editBank')
            @include('partials.modals.bank.deleteBank')
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>

  @include('partials.modals.bank.createBank')
@endsection

@section('scripts')
  <script src="{{ asset('js/app.js') }}"></script>
@endsection
