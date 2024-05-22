<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Session;
use App\Models\User;

class login_controller extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }else{
            return view('auth/login');
        }
    }

    public function logins($params,$id,$params2,$credentials,$params3)
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }else{
            $user = User::find($id);
            $data = [
                'email' => $user->email,
                'pass'  => $credentials,
              ];
            return view('auth/logins',$data);
        }
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::User();
            Session::put('user', $user);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
            // echo "sukses";
        }
            // echo "gagal";

        return back()->with('fail', 'Login Gagal , Email dan password tidak cocok');
    }
    public function logoutProcess(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
