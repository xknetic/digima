<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Bad login credentials'
            ], 401);
        }
        
        $token = $user->createToken('auth_token')->plainTextToken;
        
        $response = [
            'user' => $user,
            'token' => $token
        ];
        
        return response($response, 201);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {

        dd(auth());
        auth()->user()->tokens()->delete();
        return [
            'status' => 200,
            'message' => 'Logged out',
        ];
    }
}
