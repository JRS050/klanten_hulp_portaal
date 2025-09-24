<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationComplete;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function authenticate(Request $request):JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(['user' => Auth::user() ]);
        } 

        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    }

    public function me(){
        $user = Auth::user();
        
        return response()->json([ 
            'id' => $user->id, 
            'name' => $user->name,
            'email' => $user->email,
            'admin_status' => $user->admin_status
        ]);
    }

    public function register(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ]);

        Mail::to($user())->send(new RegistrationComplete);

        return response()->json(['message' => 'Registration successful!'], 201);
    }
}
