<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

use App\Http\Requests\KaryawanRequest;

use App\Exports\KaryawanExport;
use App\Models\Karyawan\Karyawan;
use App\Models\Master\Bagian;
use App\Models\Master\Bank;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanController extends Controller
{
	// Index
    public function index()
    {
    	$title = 'Data Karyawan';

    	$employee = Karyawan::orderBy('created_at')->with('user')->get();

    	return view('karyawan.index', compact('title', 'employee'));
    }

    // Create Karyawan
    public function create()
    {
        $title = 'Tambah Data Karyawan';

        $karyawan = new Karyawan();

        $banks = Bank::orderBy('nama_bank')->get();

        $bagian = Bagian::orderBy('nama_bagian')->get();

        return view('karyawan.create', compact('title', 'karyawan', 'banks', 'bagian'));
    }

    // Store Karyawan
    public function store(KaryawanRequest $request)
    {
        $request->merge(['nomor_telepon' => '+62' . $request->nomor_telepon]);

        $karyawan = Karyawan::create($request->except('role'));

        $karyawan->user()->create([
            'username'  => $request->nik,
            'password'  => bcrypt($request->nik),
            'role'      => $request->role
        ]);

        $this->storeImage($karyawan);

        if (auth()) {
            return redirect()
                ->route('karyawan.show', ['karyawan' => $karyawan])
                ->with('success', 'Data karyawan telah ditambahkan.');
        } else {
            return redirect()
                ->route('auth.index')
                ->with('success', 'Anda telah berhasil registrasi.');
        }
    }

    // Show Karyawan
    public function show(Karyawan $karyawan)
    {
        $title = 'Detail ' . $karyawan->nama;

    	return view('karyawan.show', compact('title', 'karyawan'));
    }

    // Edit Karyawan
    public function edit(Karyawan $karyawan)
    {
        $title = 'Edit Karyawan: ' . $karyawan->nama;

        $karyawan->load('user');

        $banks = Bank::orderBy('nama_bank')->get();

        $bagian = Bagian::orderBy('nama_bagian')->get();

    	return view('karyawan.edit', compact('title', 'karyawan', 'banks', 'bagian'));
    }

    // Update Karyawan
    public function update(KaryawanRequest $request, Karyawan $karyawan)
    {
        if ($request->has('foto') && $karyawan->foto) {
            Storage::delete('public/' . $karyawan->foto);
        }

        $request->merge(['nomor_telepon' => '+62' . $request->nomor_telepon]);

        $karyawan->update($request->except('role'));

        $karyawan->user()->update([
            'username'  => $request->nik,
            'password'  => bcrypt($request->nik),
            'role'      => $request->role
        ]);

        $this->storeImage($karyawan);

        return redirect()
                ->route('karyawan.show', ['karyawan' => $karyawan])
                ->with('success', 'Data karyawan telah diubah.');
    }

    // Destroy Karyawan
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->slipGaji()->delete();

        $karyawan->absensi()->delete();

        $karyawan->user()->delete();

        $karyawan->delete();

    	return redirect()
                ->route('karyawan.index')
                ->with('success', 'Data karyawan telah dihapus.');
    }

    // Store Image
    public function storeImage($karyawan)
    {
        if (request()->has('foto')) {
            $karyawan->update(['foto' => request()->foto->store('img/uploads', 'public')]);

            $image = Image::make(public_path('storage/' . $karyawan->foto))->fit(400, 400, null, 'top');

            $image->save();
        }
    }

    // Validasi Karyawan
    public function validasiKaryawan(Karyawan $karyawan)
    {
        $karyawan->update(['status' => 1]);

        return back()->with('success', 'Karyawan berhasil diaktifkan.');
    }

    // Non Aktifkan Karyawan
    public function nonaktifkanKaryawan(Karyawan $karyawan)
    {
        $karyawan->update(['status' => 0]);

        return back()->with('success', 'Karyawan berhasil dinonaktifkan.');
    }

    // Index Laporan Karyawan
    public function indexLaporan()
    {
        $title = 'Laporan Data Karyawan';

        $employee = Karyawan::with('user', 'bagian', 'bank')->get();

        return view('reports.karyawan.index', compact('title', 'employee'));
    }

    // Export Karyawan
    public function exportKaryawan()
    {
        try {
            $kode = Str::upper(Str::random(5));

            return Excel::download(new KaryawanExport, $kode . ' - Data Karyawan (' . request()->filter . ').xlsx');
        } catch(\Exception $e) {
            return back()->with('error', 'Silahkan isi filter.');
        }
    }
}
