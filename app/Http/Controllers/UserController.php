<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return UserResource::collection(User::all());
    }

    public function update(StoreUserRequest $request, User $user){
        $user->update($request->validated());
        $users = User::all();
        return UserResource::collection($users);
    }

    public function delete(User $user){
        $user->delete();
        return response()->json(['message' => 'User successfully deleted']);
    }
}
