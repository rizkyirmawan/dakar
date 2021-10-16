<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\Models\Auth\User;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LaporanSlipGajiTest extends DuskTestCase
{
    /**
     * [testLaporanSlipGajiPage description]
     * @test
     * @group LaporanSlipGajiPage
     * @return [type] [description]
     */
    public function testLaporanSlipGajiPage()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs(User::find(1))
                ->visit('/laporan/slip-gaji')
                ->assertSee('Laporan Slip Gaji Karyawan')
                ->screenshot('laporan-slip-gaji-page');
        });
    }
}
