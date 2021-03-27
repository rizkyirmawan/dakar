<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Karyawan\Karyawan;
use Illuminate\Support\Arr;

class KaryawanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $karyawan = [
        	[
        		'nik' => '21612566',
        		'nama' => 'Siti Zakiyah',
        		'alamat' => 'Sukanagara Cianjur',
        		'nomor_telepon' => '+6281320023526',
        		'status_nikah' => 'Belum Menikah',
        		'pendidikan' => 'S1',
        		'tanggal_masuk' => date('2021-03-05'),
        		'atas_nama_rekening' => 'Siti Zakiyah',
        		'nomor_rekening' => '1831038816',
        		'bagian_id' => 1,
        		'bank_id' => 1,
        		'status_pekerja' => 'Tetap',
        		'status' => 1,
                'username' => '21612566',
                'password' => bcrypt('21612566'),
                'role' => 'CO'
        	],
            [
                'nik' => '32051020',
                'nama' => 'Udung Phoenix',
                'alamat' => 'Jl. Jalan 555',
                'nomor_telepon' => '+6281111222333',
                'status_nikah' => 'Belum Menikah',
                'pendidikan' => 'SMA',
                'tanggal_masuk' => date('2021-01-05'),
                'atas_nama_rekening' => 'Udung Phoenix',
                'nomor_rekening' => '111222333',
                'bagian_id' => 1,
                'bank_id' => 2,
                'status_pekerja' => 'Kontrak',
                'status' => 1,
                'username' => '32051020',
                'password' => bcrypt('32051020'),
                'role' => 'SO'
            ],
            [
                'nik' => '32051030',
                'nama' => 'Adang Leviathan',
                'alamat' => 'Jl. Jalan 666',
                'nomor_telepon' => '+6281444555666',
                'status_nikah' => 'Belum Menikah',
                'pendidikan' => 'SMA',
                'tanggal_masuk' => date('2020-05-15'),
                'atas_nama_rekening' => 'Adang Leviathan',
                'nomor_rekening' => '444555666',
                'bagian_id' => 1,
                'bank_id' => 5,
                'status_pekerja' => 'Tetap',
                'status' => 1,
                'username' => '32051030',
                'password' => bcrypt('32051030'),
                'role' => 'BM'
            ],
        ];

        foreach ($karyawan as $employee) {
        	$officer = Karyawan::create(Arr::except($employee, ['username', 'password', 'role']));

        	$officer->user()->create(Arr::only($employee, ['username', 'password', 'role']));
        }
    }
}
