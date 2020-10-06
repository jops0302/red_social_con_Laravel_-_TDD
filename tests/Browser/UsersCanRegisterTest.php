<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersCanRegisterTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function user_can_register()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'OrlandoSoto')
                    ->type('first_name', 'Orlando')
                    ->type('last_name', 'Soto')
                    ->type('email', 'jops0302@gmail.com')
                    ->type('password', 'password')
                    ->type('password_confirmation', 'password')
                    ->press('@register-btn')
                    ->assertPathIs('/')
                    ->assertAuthenticated()
                    ;
        });
    }

    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function user_cannont_register_with_invalid_information()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', '')
                    ->press('@register-btn')
                    ->assertPathIs('/register')
                    ->assertPresent('@validation-errors')
                    ;
        });
    }
}
