<?php

namespace App\Http\Controllers;

use App\Shake;
use App\ShakeIngredient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CreateShake;
use Illuminate\Support\Facades\View;

class ShakeController extends Controller
{
    public function index()
    {
        $shakes = Shake::with('ingredients')->get();

        return View::make('welcome')->with('shakes', $shakes);
    }

    public function show(Shake $shake)
    {
        return View::make('shake')->with('shake', $shake);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateShake $request) : JsonResponse
    {
        $newShake = Shake::create(['title' => $request['title']]);

        //insert each ingredient, using shake.id
        foreach($request['ingredients'] as $val) {
            ShakeIngredient::create(['shake_id' => $newShake->id, 'val' => $val]);
        }

        return response()->json(['id' => $newShake->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shake  $shake
     * @return \Illuminate\Http\Response
     */
    public function edit(Shake $shake)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shake  $shake
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shake $shake)
    {
        //
    }

    public function destroy(Request $request)
    {
        $shake = Shake::find($request['id']);
        response()->json(['success' => $shake->delete()]);
    }
}
