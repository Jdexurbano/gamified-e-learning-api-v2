<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $validated = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_initial'=>'required',
            'student_No'=>'required',
            'age'=>'required|integer|min:0|max:100',
            'address'=>'required',
            'username' => 'required|unique:users|max:255',
            'password'=>'required|confirmed',
            'role'=>'required|in:admin,teacher,student',

        ]);

        $user = User::create($validated);
        return response()->json($user,201);
    }

    public function login(Request $request){
        $validated = $request->validate([

            'username'=>'required',
            'password'=>'required',
        ]);

        if (!Auth::attempt($validated)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $request->user()->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token, 'user' => Auth::user()], 200);
    }
}
