<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = User::where('role','student')->get()->values();
        return response()->json($students,200);
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
            'teacher_id' => 'required|exists:users,id',

        ]);

        $student = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'middle_initial' => $validated['middle_initial'],
            'student_No' => $validated['student_No'],
            'age' => $validated['age'],
            'address' => $validated['address'],
            'username' => $validated['username'],
            'password' =>  Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        $teacher = User::find($validated['teacher_id']);
        $teacher->students()->attach($student->id);

        return response()->json($student,201);
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
