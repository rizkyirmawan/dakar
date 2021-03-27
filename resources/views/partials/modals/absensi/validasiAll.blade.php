<div class="modal fade" id="validasi-all-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Validasi Semua Absen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Validasi semua data absensi hari ini: {{ today()->translatedFormat('d F Y') }}?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="{{ route('absensiKaryawan.validasiAll') }}" method="post">
          @method('patch')
          @csrf
          <button type="submit" class="btn btn-success d-inline">Validasi</button>
        </form>
      </div>
    </div>
  </div>
</div>