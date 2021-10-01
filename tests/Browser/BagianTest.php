<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Auth\User;

class BagianTest extends DuskTestCase
{
    /**
     * [testBagianPage description]
     * @test
     * @group bagianPage
     * @return [type] [description]
     */
    public function testBagianPage()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs(User::find(1))
                ->visit('/master/bagian')
                ->assertSee('Data Bagian')
                ->screenshot('bagian-page');
        });
    }
}
