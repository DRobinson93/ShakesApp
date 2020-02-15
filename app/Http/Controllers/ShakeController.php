<?php

namespace App\Http\Controllers;

use App\Shake;
use App\ShakeIngredient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CreateShake;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ShakeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->except(["index","show"]);
    }
    public function index()
    {
        $shakes = Shake::with('ingredients')->get();
        return View::make('welcome')->with('shakes', $shakes);
    }

    public function show(Shake $shake)
    {
        $shakeWIngs = Shake::where('id', $shake->id)->with('ingredients')->first();
        return view('shake', ['shake' => $shakeWIngs]);
    }

    public function store(CreateShake $request) : JsonResponse
    {
        $data= [];
        $data['title'] = $request->input('title');
        $data['user_id'] = Auth::id();
        $newShake = Shake::create($data);
        //insert each ingredient, using shake.id
        foreach($request->input('ingredients') as $data) {
            //$newShake->ingredient() //todo try like this
            ShakeIngredient::create(['shake_id' => $newShake->id, 'val' => $data['val']]);
        }

        return response()->json(['id' => $newShake->id]);
    }

    public function create()
    {
        return view("shakeForm");
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

    public function destroy(Shake $shake)
    {
        response()->json(['success' => $shake->delete()]);
    }
}
