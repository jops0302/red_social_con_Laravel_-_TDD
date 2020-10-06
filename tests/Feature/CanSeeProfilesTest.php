<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CanSeeProfilesTest extends TestCase
{
    use RefreshDatabase;

     /** @test */
     public function can_see_profiles_test()
     {

        factory(User::class)->create(['name' => 'Orlando']);
        $this->get('@Orlando')->assertSee('Orlando');
        
     }
}
