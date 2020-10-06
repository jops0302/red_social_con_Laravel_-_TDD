<?php

namespace Tests\Browser;

use App\Models\Comment;
use App\Models\Status;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserCanCommentStatusTest extends DuskTestCase
{

    //el metodo first obtiene el primer comentario pero el metodo shift obtine el primer comentario pero lo elimina de la coleccion
    use DatabaseMigrations;

     /** @test */
     public function users_can_see_all_comments()
     {
        $status = factory(Status::class)->create();
        $comments = factory(Comment::class, 2)->create(['status_id' => $status->id]);

        $this->browse(function (Browser $browser) use ($status, $comments) {
            $browser->visit('/')->waitForText($status->body);

                    foreach ($comments as $comment){
                        $browser->assertSee($comment->body)
                        ->assertSee($comment->user->name);
                    }
        });
     }

    /** @test */
    public function authenticated_users_can_comment_statuses()
    {
        $status = factory(Status::class)->create();
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($status, $user) {
            $comment = 'Mi primer comentario';

            $browser->loginAs($user)
                    ->visit('/')
                    ->waitForText($status->body)
                    ->type('comment', $comment)
                    ->press('@comment-btn')
                    ->waitForText($comment)
                    ->pause(4000)
                    ->assertSee($comment);
        });
    }

      /** @test */
      public function users_can_see_comments_in_real_time()
      {
        $status = factory(Status::class)->create();
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser1, Browser $browser2) use ($status, $user) {
            $comment = 'Mi primer comentario';

            $browser1->visit('/');

            $browser2->loginAs($user)
                    ->visit('/')
                    ->waitForText($status->body)
                    ->type('comment', $comment)
                    ->press('@comment-btn');

            $browser1->waitForText($comment)
            ->pause(4000)
            ->assertSee($comment);
        });
      }
}
