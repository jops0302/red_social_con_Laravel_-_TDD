<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Events\StatusCreated;
use App\Http\Resources\StatusResource;
use Illuminate\Http\Request;

class StatusesController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(){

        return StatusResource::collection(
        Status::latest()->paginate());
    }

    public function store(Request $request){

        $validStatus = $request->validate(['body'=> 'required|min:5']);

        $status = $request->user()->statuses()->create($validStatus);

        $statusResource = StatusResource::make($status);
        StatusCreated::dispatch($statusResource);

        return $statusResource;
       
    }
}
