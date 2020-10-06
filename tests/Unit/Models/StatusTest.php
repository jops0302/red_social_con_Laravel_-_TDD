<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use App\Models\Status;
use App\Traits\HasLikes;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StatusTest extends TestCase
{
    use RefreshDatabase;
    /** @test*/
    public function a_status_belongs_to_a_user()
    {
        $status = factory(Status::class)->create();

        $this->assertInstanceOf(User::class, $status->user);
    }

    /** @test*/
    public function a_status_has_many_comments()
    {
        $status = factory(Status::class)->create();

        factory(Comment::class)->create(['status_id' => $status->id]);

        $this->assertInstanceOf(Comment::class, $status->comments->first());
    }

    /** @test*/
    function a_comment_comment_model_must_use_trait_has_likes()
     {
         $this->assertClassUsesTrait(HasLikes::class, Status::class);
        
     }
   
}
