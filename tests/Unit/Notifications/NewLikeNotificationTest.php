<?php

namespace Tests\Unit\Notifications;

use App\Models\Status;
use App\Notifications\NewLikeNotification;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewLikeNotificationTest extends TestCase
{
    use RefreshDatabase;


    /** @test*/
    function the_notification_is_stored_in_the_database()
     {
        $statusOwner = factory(User::class)->create();
        $likeSender = factory(User::class)->create();

        $status = factory(Status::class)->create(['user_id' => $statusOwner->id]);

        $status->likes()->create([
            'user_id' =>  $likeSender->id
        ]);

        $statusOwner->notify(new NewLikeNotification($status, $likeSender));

        $this->assertCount(1, $statusOwner->notifications);

        $notificationsData = $statusOwner->notifications->first()->data;

        $this->assertEquals($status->path(), $notificationsData['link']);
        $this->assertEquals("Al usuario {$likeSender->name} le gusto tu publicación.", $notificationsData['message']);

        // [['link' => 'model', 'message' => 'Al usuario Orlando le gusto tu model']]

        
     }
}
