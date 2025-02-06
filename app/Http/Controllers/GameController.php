<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{

    private function getObject($gameID){

        $game = Game::find($gameID);

        if (!$game) {
            abort(404, 'Game not found');
        }
    
        return $game;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $games = Game::all();

        return response()->json($games,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $gameID)
    {
        $game = $this->getObject($gameID);

        $validated = $request->validate([
            'name'=>'required',
            'description'=>'required',
            'code'=>'required',
            'is_open'=>'required'
        ]);
        $game->update($validated);
        return response()->json($game,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
