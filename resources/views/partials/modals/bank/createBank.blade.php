<div class="modal fade" id="create-bank" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Edit Bank</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('bank.store') }}" method="post">
        <div class="modal-body">
          <div class="form-row">

            @csrf

            <div class="col-md-6">
              <label for="kode_bank" class="text-dark">Kode Bank:</label>
              <input type="text" class="form-control" name="kode_bank" value="{{ old('kode_bank') }}" required onkeypress="isNumber(event)">
            </div>

            <div class="col-md-6">
              <label for="nama_bank" class="text-dark">Nama Bank:</label>
              <input type="text" class="form-control" name="nama_bank" value="{{ old('nama_bank') }}" required>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>