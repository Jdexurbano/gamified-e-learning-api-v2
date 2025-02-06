<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    private function getObject($userID){

        $student = User::where('id', $userID)
               ->where('role', 'student')
               ->first();

        if (!$student) {
            abort(404, 'User not found');
        }
    
        return $student;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $teacher = $request->user();

        if ($teacher->role !== 'teacher') {
            return response()->json(['message' => 'Access denied'], 403);
        }

        $students = $teacher->students; // Fetch all related students

        return response()->json($students, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_initial'=>'required',
            'student_No'=>'required',
            'age'=>'required|integer|min:0|max:100',
            'address'=>'required',
            'username' => 'required|unique:users|max:255',
            'password'=>'required|confirmed',
            'role'=>'required|in:student',

        ]);
        $student = User::create($validated);

        $request->user()->students()->attach($student->id);

        return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $userID)
    {
        $student = $this->getObject($userID);

        return response()->json($student,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $userID)
    {
        $student = $this->getObject($userID);
        $validated = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_initial'=>'required',
            'student_No'=>'required',
            'age'=>'required|integer|min:0|max:100',
            'address'=>'required',
            'username' => 'required|max:255',

        ]);

        $student->update($validated);
        return response()->json($student,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $userID)
    {
        $student = $this->getObject($userID);
        $student->delete();
        return response()->json(['message'=>'student has been delete'],200);
    }
}
