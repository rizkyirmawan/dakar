<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BagianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return DB::table('bagian')->insert([
        	['nama_bagian' => 'Sukanagara Cianjur', 'gaji_pokok' => 1750000]
        ]);
    }
}
