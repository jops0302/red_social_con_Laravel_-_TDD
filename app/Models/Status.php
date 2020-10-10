<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Like;
use App\Models\Comment;
use App\Traits\HasLikes;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

class Status extends Model
{
    use HasLikes;
    
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function path(){
        return route('statuses.show', $this);
    }


     
}
