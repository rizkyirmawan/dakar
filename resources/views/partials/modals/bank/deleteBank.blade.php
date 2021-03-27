<div class="modal fade" id="delete-modal-{{ $bank->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Hapus Bank</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span class="text-dark">Anda yakin ingin menghapus data bank: {{ $bank->nama_bank }}?</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="{{ route('bank.destroy', ['bank' => $bank->id]) }}" method="post">
          @method('delete')
          @csrf
          <button type="submit" class="btn btn-danger d-inline">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>