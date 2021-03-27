<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Exports\SlipGajiExport;
use App\Models\Karyawan\Karyawan;
use App\Models\Karyawan\SlipGaji;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class SlipGajiController extends Controller
{
    // Index
    public function index()
    {
    	$title = 'Data Slip Gaji Karyawan';

        if (request()->periode) {
            $karyawanWithSlipGaji = Karyawan::with(['user', 'slipGaji' => function($query) {
                $query->whereDate('slip_gaji.periode', Carbon::parse(request()->periode)->startOfMonth());
            }])->orderBy('nik')->get(); 
        } else {
        	$karyawanWithSlipGaji = Karyawan::with(['user', 'slipGaji' => function($query) {
        		$query->whereDate('slip_gaji.periode', today()->startOfMonth());
        	}])->orderBy('nik')->get();  
        }

    	return view('slipGaji.index', compact('title', 'karyawanWithSlipGaji'));
    }

    // Store Slip Gaji Karyawan
    public function storeSlipGaji(Karyawan $karyawan, Request $request)
    {
        if ($request->insentif_level <= 4) {
            $bonusInsentif = 0;
        } else if ($request->insentif_level == 5) {
            $bonusInsentif = 150000;
        } else {
            $bonusInsentif = 300000;
        }

        if ($request->periode) {
            $periode = Carbon::parse($request->periode)->startOfMonth();
        } else {
            $periode = today()->startOfMonth();
        }
        
    	$karyawan->slipGaji()->create([
    		'periode' => $periode,
    		'insentif_net_tur' => intval(preg_replace('/,.*|[^0-9]/', '', $request->insentif_net_tur)),
    		'insentif_level' => $request->insentif_level,
            'bonus_insentif' => $bonusInsentif,
    		'tunjangan_ump' => intval(preg_replace('/,.*|[^0-9]/', '', $request->tunjangan_ump)),
    		'tunjangan_hp_mms' => intval(preg_replace('/,.*|[^0-9]/', '', $request->tunjangan_hp_mms)),
    		'fasilitas_mms' => intval(preg_replace('/,.*|[^0-9]/', '', $request->fasilitas_mms))
    	]);

    	return back()->with('success', 'Slip gaji berhasil disubmit.');
    }

    // Index Laporan Slip Gaji
    public function indexLaporan()
    {
        $title = 'Laporan Slip Gaji Karyawan';

        $slipGajiKaryawan = SlipGaji::with(['karyawan.user', 'karyawan.bagian', 'karyawan.bank'])
                            ->where('slip_gaji.periode', today()->startOfMonth())
                            ->get();

        return view('reports.slipGaji.index', compact('title', 'slipGajiKaryawan'));
    }

    // Export Slip Gaji by ID
    public function exportSlipGaji($id)
    {
        $slipGaji = SlipGaji::with(['karyawan.user', 'karyawan.bagian', 'karyawan.bank'])
                            ->where('slip_gaji.id', $id)
                            ->first();

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                    ->loadView('reports.slipGaji.exportSlipGaji', compact('slipGaji'))
                    ->setPaper('legal', 'portrait');

        return $pdf->download('[Slip Gaji] ' . $slipGaji->karyawan->nama . ' (' . \Carbon\Carbon::parse($slipGaji->periode)->translatedFormat('F Y') . ')' . '.pdf');
    }

    // Export Slip Gaji by Periode
    public function exportSlipGajiByPeriode()
    {
        $kode = Str::upper(Str::random(5));

        return Excel::download(new SlipGajiExport, $kode . ' - Slip Gaji Karyawan (' . request()->periode . ').xlsx');
    }

    // Index Community Officer
    public function indexKaryawan()
    {
        $title = 'Data Slip Gaji';

        $payroll = SlipGaji::with('karyawan.user', 'karyawan.bagian', 'karyawan.bank')
                            ->where('slip_gaji.karyawan_id', auth()->user()->userable->id)
                            ->get();

        return view('slipGaji.indexKaryawan', compact('title', 'payroll'));
    }
}
