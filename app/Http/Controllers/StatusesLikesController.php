<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusesLikesController extends Controller
{
    public function store(Status $status){
        
        $status->like();
        // $status->likes()->create([
        //     'user_id' => auth()->id()
        // ]);
    }

    public function destroy(Status $status){
        
        $status->unlike();
        // $status->likes()->create([
        //     'user_id' => auth()->id()
        // ]);
    }
}
