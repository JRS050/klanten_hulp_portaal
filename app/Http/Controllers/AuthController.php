<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/myTickets');
        }
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
}
