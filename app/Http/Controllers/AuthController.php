<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationComplete;
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
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
    /////////////////////////////////
    protected function broker()
    {
        return Password::broker();
    }

    public function forgotPasswordReset(Request $request){
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
      
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
    );
        // dd($request->token);
        // $token = Hash::make($request->token);

        // $email = DB::table('password_reset_tokens')
        //     ->where('token', '=', $token)
        //     ->value('email');

        // dd($email);
        // $response = $this->broker()->reset(
        //     $request->only('password', 'password_confirmation', 'token'),
        //     function ($user, $password) {
        //         $user->password = Hash::make($password);
        //         $user->save();
        //     }
        // );
        /////////////////////////////
        if ($response == Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password has been reset.']);
        }

        return response()->json(['error' => 'Failed to reset password.'], 400);
    }
}
