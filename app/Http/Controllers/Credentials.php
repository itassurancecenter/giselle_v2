<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class Credentials extends Controller
{
    //
    public function loginView(){
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {
// dd($request);
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ];

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/beranda');
        };

        return back()->withErrors([
            'username' => 'Username atau Password Salah',
        ]);
    }

    public function doLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
