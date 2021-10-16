<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\Models\Auth\User;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class KaryawanTest extends DuskTestCase
{
    /**
     * [testKaryawanPage description]
     * @test
     * @group karyawanPage
     * @return [type] [description]
     */
    public function testBankPage()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs(User::find(1))
                ->visit('/input/karyawan')
                ->assertSee('Data Karyawan')
                ->screenshot('karyawan-page');
        });
    }
}
