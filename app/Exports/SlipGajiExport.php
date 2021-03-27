<?php

namespace App\Exports;

use App\Models\Karyawan\SlipGaji;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SlipGajiExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
    	$slipGajiKaryawan = SlipGaji::with(['karyawan.user', 'karyawan.bagian', 'karyawan.bank'])
                            ->where('slip_gaji.periode', \Carbon\Carbon::parse(request()->periode)->startOfMonth())
                            ->get();

        return view('reports.slipGaji.exportSlipGajiExcel', compact('slipGajiKaryawan'));
    }
}
