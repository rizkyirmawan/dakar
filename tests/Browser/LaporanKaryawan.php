<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Models\Auth\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LaporanKaryawan extends DuskTestCase
{
    /**
     * [testLaporanKaryawanPage description]
     * @test
     * @group LaporankaryawanPage
     * @return [type] [description]
     */
    public function testLaporanKaryawanPage()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs(User::find(1))
                ->visit('/laporan/karyawan')
                ->assertSee('Laporan Data Karyawan')
                ->screenshot('laporan-karyawan-page');
        });
    }
}
