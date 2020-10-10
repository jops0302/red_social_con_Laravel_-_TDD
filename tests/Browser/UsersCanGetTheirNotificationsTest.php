<?php

namespace Tests\Browser;

use App\Models\Status;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Notifications\DatabaseNotification;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersCanGetTheirNotificationsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws \Throwable
     */
    public function users_can_see_their_notifications_in_the_nav_bar()
    { 
        $user = factory(User::class)->create();
        $status = factory(Status::class)->create();

        $notification = factory(DatabaseNotification::class)->create([
            'notifiable_id' => $user->id,
            'data' => [
                'message' => 'Has recibido un like',
                'link' => route('statuses.show', $status)
            ]
        ]);

        $this->browse(function (Browser $browser) use ($user, $notification, $status){
            $browser->loginAs($user)
                    ->visit('/')
                    ->click('@notifications')
                    ->assertSee('Has recibido un like')
                    ->click("@{$notification->id}")
                    ->assertUrlIs($status->path())
                    
                    ->click('@notifications')
                    ->pause(4000)
                    ->press("@mark-as-read-{$notification->id}")
                    ->waitFor("@mark-as-unread-{$notification->id}")
                    ->assertMissing("@mark-as-read-{$notification->id}")

                    ->press("@mark-as-unread-{$notification->id}")
                    ->waitFor("@mark-as-read-{$notification->id}")
                    ->assertMissing("@mark-as-unread-{$notification->id}")
                    ;
        });
    }


   /**
     * @test
     * @throws \Throwable
     */
    public function users_can_see_their_like_notifications_in_real_time()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $status = factory(Status::class)->create(['user_id' => $user1->id]);

        $this->browse(function (Browser $browser1, Browser $browser2) use ($user1, $user2, $status) {
            $browser1->loginAs($user1)
                ->visit('/')
                ->resize(1024, 768)
            ;

            $browser2->loginAs($user2)
                ->visit('/')
                ->pause(6000)
                ->press('@like-btn')
                ->pause(6000)
            ;
            $browser1->assertSeeIn('@notifications-count', 1);
        });
    }

    
   /**
     * @test
     * @throws \Throwable
     */
    public function users_can_see_their_comment_notifications_in_real_time()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $status = factory(Status::class)->create(['user_id' => $user1->id]);

        $this->browse(function (Browser $browser1, Browser $browser2) use ($user1, $user2, $status) {
            $browser1->loginAs($user1)
                ->visit('/')
                ->resize(1024, 768)
            ;

            $browser2->loginAs($user2)
                ->visit('/')
                ->pause(6000)
                ->type('comment', 'Mi comentario')
                ->press('@comment-btn')
                ->pause(6000)
            ;
            $browser1->assertSeeIn('@notifications-count', 1);
        });
    }
}
