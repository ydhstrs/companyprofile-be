<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        // Create new user
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        // Generate new token for user
        $token = $user->createToken('user_token')->plainTextToken;

        // Return relevant information
        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    /**
     * Login
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try {
            // Get the user by email if exists
            $user = User::where('email', '=', $request->input('email'))->firstOrFail();

            if (!Hash::check($request->input('password'), $user->password)) {
                return response()->json(['error' => 'Something went wrong login in? Please try again.'], 400);
            }

            // Generate new token for user
            $token = $user->createToken('user_token')->plainTextToken;

            // Return relevant information
            return response()->json(['user' => $user, 'token' => $token], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong? Please try again.'], 400);
        }
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            $user = User::findOrFail($request->get('user_id'));

            $user->tokens()->delete();

            return response()->json('User logged out', 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong in AuthController.logout | ' . $e->getMessage()], 400);
        }
    }
}
