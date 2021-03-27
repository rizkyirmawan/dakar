<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Master\Bank;

class BankController extends Controller
{
    // Index
    public function index()
    {
    	$title = 'Data Bank';

    	$banks = Bank::orderBy('kode_bank')->get();

    	return view('bank.index', compact('title', 'banks'));
    }

    // Store Bank
    public function store(Request $request)
    {
        try {
            $bank = Bank::create($request->all());

            return back()->with('success', 'Data bank telah ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Tolong isi semua field.');
        }
    }

    // Update Bank
    public function update(Request $request, Bank $bank)
    {
        try {
            $bank->update($request->all());

            return back()->with('success', 'Data bank telah diubah.');
        } catch (\Exception $e) {
            return back()->with('error', 'Tolong isi semua field.');
        }
    }

    // Destroy Bank
    public function destroy(Bank $bank)
    {
        if ($bank->karyawan) {
            return back()->with('error', 'Terdapat karyawan yang terkait dengan bank ini.');
        } else {
            $bank->delete();

            return back()->with('success', 'Data bank telah dihapus.');
        }
    }
}
