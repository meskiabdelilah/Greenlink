<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        // Validation
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Create user
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        // Create token
        $token = $user->createToken('auth_token')->plainTextToken;
        // response
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }


    public function login(Request $request)
    {
        // Validation
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check user
        $user = User::where('email', $fields['email'])->first();

        // Verify password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Check if user is banned .
        if ($user->is_banned) {
            return response()->json([
                'message' => 'Your account is banned'
            ], 403);
        }

        // Create token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Response
        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }


    // Logout 
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }


    // Profile
    public function profile(Request $request)
    {
        return response()->json($request->user());
    }
}
