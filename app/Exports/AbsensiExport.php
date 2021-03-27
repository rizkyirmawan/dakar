<?php

namespace App\Exports;

use App\Models\Karyawan\Karyawan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Carbon\Carbon;

class AbsensiExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
    	if (request()->filter == 'Mingguan') {
    		$karyawanWithAbsensi = Karyawan::with(['user', 'absensi' => function($query) {
	            $query  ->whereDate('absensi.tanggal', '>=', today()->subDays(7))
	                    ->whereDate('absensi.tanggal', '<=', today());
	        }])->get();
    	} elseif (request()->filter == 'Bulanan') {
    		$karyawanWithAbsensi = Karyawan::with(['user', 'absensi' => function($query) {
	            $query  ->whereDate('absensi.tanggal', '>=', today()->subDays(30))
	                    ->whereDate('absensi.tanggal', '<=', today());
	        }])->get();
    	} elseif (request()->filter == 'Tahunan') {
    		$karyawanWithAbsensi = Karyawan::with(['user', 'absensi' => function($query) {
	            $query  ->whereDate('absensi.tanggal', '>=', today()->subDays(365))
	                    ->whereDate('absensi.tanggal', '<=', today());
	        }])->get();
    	}

        return view('reports.absensi.exportAbsensi', compact('karyawanWithAbsensi'));
    }
}
