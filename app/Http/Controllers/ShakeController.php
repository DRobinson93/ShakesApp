<?php

namespace App\Http\Controllers;

use App\Shake;
use App\ShakeIngredient;
use App\ShakeReaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CreateShake;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ShakeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->except(["index","show", "reactionSumTxt"]);
    }
    public function index()
    {
        $shakes = Shake::with(['ingredients'])->get();
        foreach($shakes as $index => $shake){
            $shakes[$index]['reactionsSumTxt'] = $this->getReactionsSumTxt($shake);
        }
        return View::make('welcome')->with('shakes', $shakes);
    }

    public function reactionSumTxt(Shake $shake){
        return response($this->getReactionsSumTxt($shake));
    }

    private function getReactionsSumTxt(Shake $shake){
        $sum = $shake->reactions()->sum('val');
        return strval( ($sum >=0 ? '+' : ''). $sum );
    }

    public function getUserReaction(Shake $shake){
        $reaction = ShakeReaction::DEFAULT_VAL;
        if(Auth::check()){
            $result = $shake->reactions()->where(['user_id' => Auth::id()])->first();
            if($result){
                $reaction = $result->val;
            }
        }
        return response($reaction);
    }

    public function show(Shake $shake)
    {

        return view('shake', ['shake' => $shake]);
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
