<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Master\Bagian;

class BagianController extends Controller
{
    // Index
    public function index()
    {
    	$title = 'Data Bagian';

    	$bagian = Bagian::orderBy('nama_bagian')->get();

    	return view('bagian.index', compact('title', 'bagian'));
    }

    // Store Bagian
    public function store(Request $request)
    {
        try {
            $request->merge(['gaji_pokok' => intval(preg_replace('/,.*|[^0-9]/', '', $request->gaji_pokok))]);

            $bagian = Bagian::create($request->all());

            return back()->with('success', 'Data bagian telah ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Tolong isi semua field.');
        }
    }

    // Update Bagian
    public function update(Request $request, Bagian $bagian)
    {
        try {
            $request->merge(['gaji_pokok' => intval(preg_replace('/,.*|[^0-9]/', '', $request->gaji_pokok))]);

            $bagian->update($request->all());

            return back()->with('success', 'Data bagian telah diubah.');
        } catch (\Exception $e) {
            return back()->with('error', 'Tolong isi semua field.');
        }
    }

    // Destroy Bagian
    public function destroy(Bagian $bagian)
    {
        if ($bagian->karyawan) {
            return back()->with('error', 'Terdapat karyawan yang terkait dengan bagian ini.');
        } else {
            $bagian->delete();

        	return back()->with('success', 'Data bagian telah dihapus.');
        }
    }
}
