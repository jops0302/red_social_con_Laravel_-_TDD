<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersCanLoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     * @test
     * @throws
     * @return void
     */
    public function registered_users_can_login()
    {
        factory(User::class)->create(['email' => 'jops0302@gmail.com']);

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', 'jops0302@gmail.com')
                    ->type('password', 'password')
                    ->press('@login-btn')
                    ->assertPathIs('/')
                    ->assertAuthenticated();
        });
    }

     /**
     * A Dusk test example.
     * @test
     * @throws
     * @return void
     */
    public function user_cannot_login_with_invalid_information()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email', '')
                    ->press('@login-btn')
                    ->assertPathIs('/login')
                    ->assertPresent('@validation-errors')
                    ;
        });
    }
}
