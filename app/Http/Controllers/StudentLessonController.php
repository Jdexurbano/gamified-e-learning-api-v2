<?php

namespace App\Http\Controllers;

use App\Models\lesson;
use Illuminate\Http\Request;

class StudentLessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $user = $request->user();

       $lesson =  lesson::whereIn('teacher_id', $user->teachers()->pluck('users.id'))->get();

        return response()->json($lesson,200); 
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
