<div class="modal fade" id="create-slip-gaji-{{ $karyawan->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Buat Slip Gaji</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('slipGaji.store', ['karyawan' => $karyawan->id]) }}" method="post">
        <div class="modal-body">
          <h5 class="text-dark">Informasi Karyawan</h5>
          <hr>
          <table class="table table-bordered">
            <tr>
              <td class="text-dark font-weight-bold">NIK</td>
              <td class="text-dark">: {{ $karyawan->nik }}</td>
            </tr>
            <tr>
              <td class="text-dark font-weight-bold">Nama</td>
              <td class="text-dark">: {{ $karyawan->nama }}</td>
            </tr>
            <tr>
              <td class="text-dark font-weight-bold">Bagian (Daerah)</td>
              <td class="text-dark">: {{ $karyawan->bagian->nama_bagian }}</td>
            </tr>
          </table>
          <hr>

          <div class="form-row">

            @csrf

            <input type="hidden" name="periode" value="{{ request()->periode }}">

            <div class="col-md-6 mb-2">
              <label for="insentif_net_tur" class="text-dark">Insentif Net Tur:</label>
              <input type="text" class="form-control" name="insentif_net_tur" value="{{ old('insentif_net_tur') }}" required id="input-rupiah" onkeypress="isNumber(event)">
            </div>

            <div class="col-md-6 mb-2">
              <label for="insentif_level" class="text-dark">Insentif Level:</label>
              <select name="insentif_level" class="form-control">
                <option selected disabled>Pilih Insentif Level</option>
                @for($i = 1; $i <= 8; $i++)
                  <option value="{{ $i }}">Level {{ $i }}</option>
                @endfor
              </select>
            </div>

            <div class="col-md-4 mb-2">
              <label for="tunjangan_ump" class="text-dark">Tunjangan UMP:</label>
              <input type="text" class="form-control" name="tunjangan_ump" value="{{ old('tunjangan_ump') }}" required id="input-rupiah" onkeypress="isNumber(event)">
            </div>

            <div class="col-md-4 mb-2">
              <label for="tunjangan_hp_mms" class="text-dark">Tunjangan HP MMS:</label>
              <input type="text" class="form-control" name="tunjangan_hp_mms" value="{{ old('tunjangan_hp_mms') }}" required id="input-rupiah" onkeypress="isNumber(event)">
            </div>

            <div class="col-md-4 mb-2">
              <label for="fasilitas_mms" class="text-dark">Fasilitas MMS:</label>
              <input type="text" class="form-control" name="fasilitas_mms" value="{{ old('fasilitas_mms') }}" required id="input-rupiah" onkeypress="isNumber(event)">
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>