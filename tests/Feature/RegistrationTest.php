<?php

namespace Tests\Feature;

use Hash;
use App\User;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
   public function users_can_register()
   {
    //  $this->withoutExceptionHandling(); esta linea es para manejo de excepciones que phpunit pasa por alto
        // $this->withoutExceptionHandling();

        $this->get(route('register'))->assertSuccessful();

        $response = $this->post(route('register'), $this->userValidData());

        $response->assertRedirect('/');

        $this->assertDatabaseHas('users',[
            'name' => 'ClaudiaSoto2',
            'first_name' => 'Claudia',
            'last_name' => 'Soto',
            'email' => 'jops0302@gmail.com',
        ]);

        $this->assertTrue(
            Hash::check('password', User::first()->password),
            'La contraseña debe ser incriptada'
        );
   }

    /** @test */
   public function the_name_is_required()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['name' => null])
        )->assertSessionHasErrors('name');
   }

   /** @test */
   public function the_name_must_be_a_string()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['name' => 1512])
        )->assertSessionHasErrors('name');
   }

   /** @test */
   public function the_name_may_not_be_greater_than_60_character()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['name' => Str::random(61)])
        )->assertSessionHasErrors('name');
   }

   /** @test */
   public function the_name_must_be_at_least_3_character()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['name' => 'jo'])
        )->assertSessionHasErrors('name');
   }

     /** @test */
    public function the_name_must_be_unique()
    {
         factory(User::class)->create(['name' => 'OrlandoSoto']);
         $this->post(
             route('register'), 
             $this->userValidData(['name' => 'OrlandoSoto'])
         )->assertSessionHasErrors('name');
    }

    /** @test */
   public function the_name_may_only_contain_letters_and_numbers()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['name' => 'Orlando Soto'])
        )->assertSessionHasErrors('name');

         $this->post(
             route('register'), 
             $this->userValidData(['name' => 'OrlandoSoto2<>'])
         )->assertSessionHasErrors('name');
   }
  


   /** @test */
   public function the_first_name_is_required()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['first_name' => null])
        )->assertSessionHasErrors('first_name');
   }

   /** @test */
   public function the_first_name_must_be_a_string()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['first_name' => 1512])
        )->assertSessionHasErrors('first_name');
   }

   /** @test */
   public function the_first_name_may_not_be_greater_than_60_character()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['first_name' => Str::random(61)])
        )->assertSessionHasErrors('first_name');
   }

   /** @test */
   public function the_first_name_must_be_at_least_3_character()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['first_name' => 'jo'])
        )->assertSessionHasErrors('first_name');
   }

   /** @test */
  public function the_first_name_may_only_contain_letters()
  {
       $this->post(
           route('register'), 
           $this->userValidData(['first_name' => 'Orlando2'])
       )->assertSessionHasErrors('first_name');

        $this->post(
            route('register'), 
            $this->userValidData(['first_name' => 'Orlando<>'])
        )->assertSessionHasErrors('first_name');
  }


   /** @test */
   public function the_last_name_is_required()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['last_name' => null])
        )->assertSessionHasErrors('last_name');
   }

   /** @test */
   public function the_last_name_must_be_a_string()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['last_name' => 1512])
        )->assertSessionHasErrors('last_name');
   }

   /** @test */
   public function the_last_name_may_not_be_greater_than_60_character()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['last_name' => Str::random(61)])
        )->assertSessionHasErrors('last_name');
   }

   /** @test */
   public function the_last_name_must_be_at_least_3_character()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['last_name' => 'jo'])
        )->assertSessionHasErrors('last_name');
   }

   /** @test */
  public function the_last_name_may_only_contain_letters()
  {
       $this->post(
           route('register'), 
           $this->userValidData(['last_name' => 'Orlando2'])
       )->assertSessionHasErrors('last_name');

        $this->post(
            route('register'), 
            $this->userValidData(['last_name' => 'Orlando<>'])
        )->assertSessionHasErrors('last_name');
  }




    /** @test */
    public function the_email_is_required()
    {
         $this->post(
             route('register'), 
             $this->userValidData(['email' => null])
         )->assertSessionHasErrors('email');
    }

     /** @test */
    public function the_email_must_be_a_valid_email_address()
    {
        $this->post(
            route('register'), 
            $this->userValidData(['email' => 'invalid'])
        )->assertSessionHasErrors('email');
    }

    /** @test */
   public function the_email_must_be_unique()
   {
       factory(User::class)->create(['email' => 'jops0302@gmail.com']);
       $this->post(
           route('register'), 
           $this->userValidData(['email' => 'jops0302@gmail.com'])
       )->assertSessionHasErrors('email');
   }

   /** @test */
    public function the_password_email_is_required()
    {
         $this->post(
             route('register'), 
             $this->userValidData(['password' => null])
         )->assertSessionHasErrors('password');
    }

     /** @test */
   public function the_password_must_be_a_string()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['password' => 1512])
        )->assertSessionHasErrors('password');
   }

   /** @test */
   public function the_password_must_be_at_least_8_character()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['password' => 'joseo'])
        )->assertSessionHasErrors('password');
   }

   /** @test */
   public function the_password_must_be_confirmed()
   {
        $this->post(
            route('register'), 
            $this->userValidData(['password' => 'joseorlando','password_confirmation' => null])
        )->assertSessionHasErrors('password');
   }





   /**
    * @param array $overrides
    * @return array
    */
   protected function userValidData($overrides = []){
       return array_merge([
        'name' => 'ClaudiaSoto2',
        'first_name' => 'Claudia',
        'last_name' => 'Soto',
        'email' => 'jops0302@gmail.com',
        'password' => 'password',
        'password_confirmation' => 'password',
       ], $overrides);
   }
}
