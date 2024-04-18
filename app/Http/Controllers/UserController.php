<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function getUsers() {
        $users = UserResource::collection(User::all());
        return response()->json($users, 200, [], JSON_PRETTY_PRINT);
    }

    public function getUser($id) {
        $user = new UserResource(User::find($id));
        return response()->json($user, 200, [], JSON_PRETTY_PRINT);
    }
}
