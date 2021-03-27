<div class="modal fade" id="edit-modal-{{ $jabatan->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Edit Bagian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('bagian.update', ['bagian' => $jabatan->id]) }}" method="post">
        <div class="modal-body">
          <div class="form-row">

            @method('patch')

            @csrf

            <div class="col-md-6">
              <label for="nama_bagian" class="text-dark">Nama Bagian:</label>
              <input type="text" class="form-control" name="nama_bagian" value="{{ $jabatan->nama_bagian }}" required>
            </div>

            <div class="col-md-6">
              <label for="gaji_pokok" class="text-dark">Gaji Pokok:</label>
              <input type="text" class="form-control" name="gaji_pokok" value="{{ $jabatan->gaji_pokok }}" required id="input-rupiah" onkeypress="isNumber(event)">
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>