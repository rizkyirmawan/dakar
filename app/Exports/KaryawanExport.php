<?php

namespace App\Exports;

use App\Models\Karyawan\Karyawan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KaryawanExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
    	if (request()->filter == 'TM') {
    		$employee = Karyawan::with('user', 'bagian', 'absensi')
    							->whereDate('tanggal_masuk', '>=', request()->tanggal_awal)
    							->whereDate('tanggal_masuk', '<=', request()->tanggal_akhir)
    							->get();
    	} elseif (request()->filter == 'ST') {
    		$employee = Karyawan::with('user', 'bagian', 'absensi')
    							->where('status', request()->status)
    							->get();
    	}

        return view('reports.karyawan.exportKaryawan', compact('employee'));
    }
}
