<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationComplete;
use App\Mail\ResetPassword;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function adminList(){
        $admin_list = User::where('admin_status',1)->get();
        return response()->json([
            'admins' => $admin_list,
        ]);
    }

    public function register(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
            'admin_status' => ['required'],
        ]);

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'admin_status' => $credentials['admin_status'],
        ]);

        Mail::to($user)->send(new RegistrationComplete);

        return response()->json(['message' => 'Registration successful!'], 201);
    }


    public function forgotPasswordRequest(Request $request){
        $request->validate(['email' => 'required|email|exists:users,email']);
        
        $token = Str::random(40);
        $user = User::where('email', $request->email)->first();
        $user->reset_token = $token;
        $user->save();

        Mail::to($user)->send(new ResetPassword($user));
    
        return response()->json(['message' => 'Reset link sent.'], 201);
    }

    public function forgotPasswordReset(Request $request){
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('reset_token', $request->token)->first();
        $user->password = $request->password;
        $user->reset_token = null;
        $user->save();

        return response()->json(['message' => 'Password has been reset.'],200);

        return response()->json(['error' => 'Failed to reset password.'], 400);
    }
}
