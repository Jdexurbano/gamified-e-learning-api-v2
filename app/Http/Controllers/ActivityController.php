<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    private function calculateRating($score)
    {
    if ($score >= 9) return 5;
    if ($score >= 7) return 4;
    if ($score >= 5) return 3;
    if ($score >= 3) return 2;
    return 1;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $acitivies = Activity::where('student_id',$user->id)->get();
        return response()->json($acitivies,200);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $user = auth()->user();
       $validated =  $request->validate([
            'game' => 'required|string',
            'score' => 'required|integer',
        ]);

      $validated['student_id'] = $user->id;
    
        // Check if the user already played this game
        $activity = Activity::where('student_id', $validated['student_id'])
                            ->where('game', $validated['game'])
                            ->first();
  
        if ($activity) {
            // Calculate new average score
            $newScore = ($activity->score + $validated['score']) / 2;
            $rating = $this->calculateRating($newScore);
    
            // Update existing activity
            $activity->update([
                'score' => $newScore,
                'rating' => $rating
            ]);
            return response()->json($activity, 200); 
        } else {
            
            // Calculate rating for the new game entry
            $rating = $this->calculateRating($validated['score']);
    
            // Create a new activity entry
            $activity = Activity::create([
                'game' => $validated['game'],
                'score' => $validated['score'],
                'rating' => $rating,
                'student_id' => $validated['student_id'],
            ]);
            return response()->json($activity, 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
