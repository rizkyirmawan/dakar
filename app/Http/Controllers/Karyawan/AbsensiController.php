<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Exports\AbsensiExport;
use App\Models\Karyawan\Absensi;
use App\Models\Karyawan\Karyawan;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    // Store Absen
    public function storeAbsen()
    {
    	$karyawanId = auth()->user()->userable->id;

    	$absen = Absensi::create([
    		'karyawan_id' => $karyawanId,
    		'tanggal' => today(),
    		'status' => 0
    	]);

    	return redirect()
    			->route('dasbor.index')
    			->with('success', 'Terimakasih atas kehadirannya!');
    }

    // Index Karyawan with Absen
    public function index()
    {
        $title = 'Data Absensi';

        $absensiToday = Absensi::with('karyawan')
                            ->whereDate('tanggal', today())
                            ->get();

        $absensiBelumValid = Absensi::with('karyawan')
                            ->whereDate('tanggal', today())
                            ->where('status', 0)
                            ->count();

        return view('absensi.index', compact('title', 'absensiToday', 'absensiBelumValid'));
    }

    // Validasi Absen Hari Ini
    public function validasi(Absensi $absensi)
    {
        $absensi->update(['status' => 1]);

        return back()->with('success', 'Absensi telah divalidasi.');
    }

    // Validasi Semua Absen Hari Ini
    public function validasiAll()
    {
        Absensi::with('karyawan')
                ->whereDate('tanggal', today())
                ->where('status', 0)
                ->update(['status' => 1]);

        return redirect()
                ->route('absensiKaryawan.index')
                ->with('success', 'Semua absensi hari ini telah divalidasi.');
    }

    // Index Laporan Absensi
    public function indexLaporan()
    {
        $title = 'Laporan Data Absensi Karyawan';

        $karyawanWithAbsensi = Karyawan::with(['absensi' => function($query) {
            $query  ->whereMonth('absensi.tanggal', today()->month)
                    ->whereYear('absensi.tanggal', today()->year);
        }])->get();

        return view('reports.absensi.index', compact('title', 'karyawanWithAbsensi'));
    }

    // Export Absensi
    public function exportAbsensi()
    {
        $kode = Str::upper(Str::random(5));

        return Excel::download(new AbsensiExport, $kode . ' - Absensi Karyawan (' . request()->filter . ').xlsx');
    }
}
