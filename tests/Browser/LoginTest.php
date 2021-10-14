<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * [testLoginPage description]
     * @test
     * @group loginTest
     * @return [type] [description]
     */
    public function testLoginPage()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/')
                ->assertSee('Copyright © DAKAR 2021')
                ->screenshot('login-page');
        });
    }

    /**
     * [testLoginAdmin description]
     * @test
     * @group loginTest
     * @return [type] [description]
     */
    public function testLoginAdmin()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/')
                ->type('username', 'admin@btpn.com')
                ->type('password', 'password')
                ->press('Login')
                ->assertSee('Administrator')
                ->screenshot('login-admin');
        });
    }

    /**
     * [testLoginAdminFailed description]
     * @test
     * @group loginTest
     * @return [type] [description]
     */
    public function testLoginAdminFailed()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/')
                ->type('username', 'admin@btpn.com')
                ->type('password', '123')
                ->press('Login')
                ->assertSee('Kesalahan. Anda tidak memiliki akses atau belum terdaftar.')
                ->screenshot('login-admin-failed');
        });
    }
}
