<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TeacherController extends Controller
{

    private function getObject($teacherID){

        $teacher = User::where('id', $teacherID)
               ->where('role', 'teacher')
               ->first();

        if (!$teacher) {
            abort(404, 'User not found');
        }
    
        return $teacher;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $teachers = User::where('role','teacher')->get()->values();

        return response()->json($teachers,200);
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
            'role'=>'required|in:teacher',

        ]);

        $teacher = User::create($validated);

        return response()->json($teacher,201);
    }

    /**
     * Display the specified resource.
     */
    public function show( $teacherID)
    {
        $teacher = $this->getObject($teacherID);

        return response()->json($teacher,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $teacherID)
    {
        $teacher = $this->getObject($teacherID);

        $validated = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_initial'=>'required',
            'student_No'=>'required',
            'age'=>'required|integer|min:0|max:100',
            'address'=>'required',
            'username' => 'required|max:255',

        ]);

        $teacher->update($validated);
        return response()->json($teacher,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $teacherID)
    {
        $teacher = $this->getObject($teacherID);
        $teacher->delete();
        return response()->json(['message'=>'teacher has been delete'],200);
    }
}
