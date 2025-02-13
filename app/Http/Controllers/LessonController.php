<?php

namespace App\Http\Controllers;

use App\Models\lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{

    private function getObject($lessonID, $request){
        $user = $request->user();

        $lesson = lesson::where('id', $lessonID)
               ->where('teacher_id', $user->id)
               ->first();

        if (!$lesson) {
            abort(404, 'lesson not found');
        }
    
        return $lesson;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $lessons = Lesson::where('teacher_id', $user->id)->get();
        return response()->json($lessons,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if ($user->role !== 'teacher') {
            return response()->json(['message' => 'Only teachers can add lessons'], 403);
        }

        $validated = $request->validate([
            'title'=>'required',
            'youtube_link'=>'required',
            'is_open'=>'required|boolean'
        ]);

        $validated['teacher_id'] = $user->id;
        $lesson = Lesson::create($validated);

        return response()->json($lesson, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,  $lessonID)
    {
        $lesson = $this->getObject($lessonID, $request);;

        return response()->json($lesson);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $lessonID)
    {
        $lesson = $this->getObject($lessonID, $request);

        $validated = $request->validate([
            'title'=>'required',
            'youtube_link'=>'required',
            'is_open'=>'required|boolean'
        ]);
        $lesson->update($validated);
        return response()->json($lesson,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,  $lessonID)
    {
        $lesson = $this->getObject($lessonID, $request);

        $lesson->delete();
        return response()->json($lesson,201);
    }
}
