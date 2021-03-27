<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankTableSeeder extends Seeder
{
    public function run()
    {
        return DB::table('bank')->insert([
        	['kode_bank' => '014', 'nama_bank' => 'BCA'],
        	['kode_bank' => '008', 'nama_bank' => 'Mandiri'],
        	['kode_bank' => '009', 'nama_bank' => 'BNI'],
        	['kode_bank' => '002', 'nama_bank' => 'BRI'],
        	['kode_bank' => '022', 'nama_bank' => 'CIMB Niaga'],
        	['kode_bank' => '147', 'nama_bank' => 'Muamalat'],
        	['kode_bank' => '213', 'nama_bank' => 'JENIUS'],
        	['kode_bank' => '011', 'nama_bank' => 'Danamon'],
        	['kode_bank' => '028', 'nama_bank' => 'OCBC NISP'],
        ]);
    }
}
