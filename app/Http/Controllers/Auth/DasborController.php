<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Models\Karyawan\Absensi;
use App\Models\Karyawan\Karyawan;

class DasborController extends Controller
{
    // Index
    public function index()
    {
    	$title = 'Dasbor';

    	$absenToday = null;

        $karyawanAll = Karyawan::count();

        $karyawanAktif = Karyawan::where('status', 1)->count();

        $karyawanTidakAktif = Karyawan::where('status', '!=', 1)->count();

    	if (auth() && auth()->user()->role == 'CO') {
    		$absenToday = Absensi::whereDate('tanggal', today())
    							->where('karyawan_id', auth()->user()->userable->id)
    							->first();
    	}

    	return view('auth.dasbor', compact('title', 'absenToday', 'karyawanAll', 'karyawanAktif', 'karyawanTidakAktif'));
    }
}
