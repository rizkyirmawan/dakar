<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Auth\User;

class BankTest extends DuskTestCase
{
    /**
     * [testLoginPage description]
     * @test
     * @group bankPage
     * @return [type] [description]
     */
    public function testBankPage()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs(User::find(1))
                ->visit('/master/bank')
                ->assertSee('Data Bank')
                ->screenshot('bank-page');
        });
    }
}
