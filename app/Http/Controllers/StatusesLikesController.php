<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusesLikesController extends Controller
{
    public function store(Status $status){
        
        $status->like();

        return response()->json([
            'likes_count' => $status->likesCount()
        ]);
        // $status->likes()->create([
        //     'user_id' => auth()->id()
        // ]);
    }

    public function destroy(Status $status){
        
        $status->unlike();

        return response()->json([
            'likes_count' => $status->likesCount()
        ]);
        // $status->likes()->create([
        //     'user_id' => auth()->id()
        // ]);
    }
}
