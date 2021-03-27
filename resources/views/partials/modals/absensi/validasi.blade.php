<div class="modal fade" id="validasi-modal-{{ $absen->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Validasi Absen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tr>
            <td class="font-weight-bold">NIK</td>
            <td>: {{ $absen->karyawan->nik }}</td>
          </tr>
          <tr>
            <td class="font-weight-bold">Nama</td>
            <td>: {{ $absen->karyawan->nama }}</td>
          </tr>
          <tr>
            <td class="font-weight-bold">Tanggal</td>
            <td>: {{ \Carbon\Carbon::parse($absen->created_at)->translatedFormat('d F Y') }}</td>
          </tr>
          <tr>
            <td class="font-weight-bold">Waktu</td>
            <td>: {{ \Carbon\Carbon::parse($absen->created_at)->format('H:i') }}</td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <form action="{{ route('absensiKaryawan.validasi', ['absensi' => $absen->id]) }}" method="post">
          @method('patch')
          @csrf
          <button type="submit" class="btn btn-success d-inline">Validasi</button>
        </form>
      </div>
    </div>
  </div>
</div>