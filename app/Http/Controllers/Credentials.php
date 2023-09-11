<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class Credentials extends Controller
{
    //
    public function loginView(){
        return view('auth.login');
    }

    public function doLogin(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'username' => $request->input('username'),
            'password' => md5($request->input('password'))
        ];

        $data_pevita = User::where('username', $request->username)->first();
        // dd($credentials);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/beranda');
        };

        return back()->withErrors([
            'username' => 'username yang anda masukkan salah'
        ])->onlyInput('username');
    }
}
