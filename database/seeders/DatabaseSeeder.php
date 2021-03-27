<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(BagianTableSeeder::class);
        $this->call(BankTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(KaryawanTableSeeder::class);
    }
}
