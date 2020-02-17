<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShakeReaction as ShakeReactionRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Shake;
use App\ShakeReaction;
use Illuminate\Support\Facades\Auth;

class ShakeReactionController extends Controller
{
    //reactions are only set and updated, removing a reaction sets it to 0
    public function store(ShakeReactionRequest $request, Shake $shake) : JsonResponse
    {
        $shakeReaction = ShakeReaction::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'shake_id' => $shake->id
            ], ['val' => $request->input('val')]
        );
        return response()->json(['success' => 1]);
    }
}
