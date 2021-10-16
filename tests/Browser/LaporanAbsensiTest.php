<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\Models\Auth\User;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LaporanAbsensiTest extends DuskTestCase
{
    /**
     * [testLaporanAbsensiPage description]
     * @test
     * @group LaporanAbsensiPage
     * @return [type] [description]
     */
    public function testLaporanAbsensiPage()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs(User::find(1))
                ->visit('/laporan/absensi')
                ->assertSee('Laporan Absensi Community Officer')
                ->screenshot('laporan-absensi-page');
        });
    }
}
