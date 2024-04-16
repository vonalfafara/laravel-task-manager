<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    function register(Request $request) {
        $fields = $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed"
        ]);

        $user = User::create([
            "name" => $fields["name"],
            "email" => $fields["email"],
            "password" => Hash::make($fields["password"])
        ]);

        $token = $user->createToken("secret")->plainTextToken;

        return response()->json([
            "message" => "User has been registered",
            "user" => $user,
            "token" => $token
        ], 201, [], JSON_PRETTY_PRINT);
    }

    function login(Request $request) {
        $fields = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = User::where("email", $fields["email"])->first();

        if (!$user) {
            return response()->json([
                "message" => "Email does not exist"
            ], 404, [], JSON_PRETTY_PRINT);
        }

        $token = $user->createToken("secret")->plainTextToken;

        return response()->json([
            "message" => "Logged in successfully",
            "user" => $user,
            "token" => $token
        ], 200, [], JSON_PRETTY_PRINT);
    }

    function logout() {
        auth()->user()->tokens()->delete();

        return response()->json([
            "message" => "Logged out"
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
