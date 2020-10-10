<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\User;
use Illuminate\Http\Request;

class AcceptFriendshipsController extends Controller
{
    public function index(Request $request)
    {
    
       return view('friendships.index',[
           'friendshipRequests' => $request->user()->friendshipRequestsRecevied
       ]);
    }


    public function store(Request $request, User $sender)
    {

        $request->user()->acceptFriendRequestFrom($sender);

        return response()->json([
            'friendship_status' => 'accepted'
        ]);
    }


    public function destroy(Request $request, User $sender)
    {
        
        $request->user()->denyFriendRequestFrom($sender);

        return response()->json([
            'friendship_status' => 'denied'
        ]);
    }
}
