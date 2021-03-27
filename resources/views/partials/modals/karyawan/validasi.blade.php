<div class="modal fade" id="validasi-{{ $karyawan->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Aktifkan Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Aktifkan karyawan: {{ $karyawan->nik . ' - ' . $karyawan->nama }}?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="{{ route('karyawan.validasi', ['karyawan' => $karyawan->id]) }}" method="post">
          @method('patch')
          @csrf
          <button type="submit" class="btn btn-success d-inline">Aktifkan</button>
        </form>
      </div>
    </div>
  </div>
</div>