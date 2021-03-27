<div class="modal fade" id="delete-karyawan-{{ $karyawan->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Hapus data karyawan atas nama: {{ $karyawan->nama }}?</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        <form action="{{ route('karyawan.destroy', ['karyawan' => $karyawan->id]) }}" method="post" class="d-inline">
          
          @method('delete')

          @csrf

          <button type="submit" class="btn btn-danger">Hapus</button>

        </form>
      </div>
    </div>
  </div>
</div>