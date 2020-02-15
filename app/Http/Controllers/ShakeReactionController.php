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
    public function store(ShakeReactionRequest $request, Shake $shake) : JsonResponse
    {
        $shakeReaction = new ShakeReaction();
        $shakeReaction->val = $request->input('val');
        $shakeReaction->user_id = Auth::id();
        $shakeReaction->shake_id = $shake->id;
        $shakeReaction->save();
        return response()->json(['id' => $shakeReaction->id]);
    }

    public function update(Request $request, ShakeReactionRequest $shakeReaction)
    {
        $shakeReaction->update($request->input());
        return response(['success' => true]);
    }

    //destroy, get reaction sum should be on shake
    //get should be on user
}
