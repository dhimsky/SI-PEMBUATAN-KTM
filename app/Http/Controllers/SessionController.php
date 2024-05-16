<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function index () {
        $user = Auth::user();
        if ($user) {
            if ($user->role_id == '1' || $user->role_id == '3') {
                return redirect()->intended('dashboard');
            } elseif ($user->role_id == '2') {
                return redirect()->intended('home');
            }
        }
        return view('login');
    }
    function login(Request $request)
    {
        Session::flash('nim', $request->input('nim'));
    
        $request->validate([
            'nim' => 'required',
            'password' => 'required',
        ],[
            'nim.required' => 'masukan nim',
            'password.required' => 'masukan password'
        ]);
    
        $credentials = $request->only('nim', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role_id == '1' || $user->role_id == '3') {
                activity()->causedBy(Auth::user())->log('User Admin ' . auth()->user()->nim . ' melakukan login');
                return redirect()->intended('dashboard')->with('toast_success','Selamat, anda berhasil masuk.');
            } elseif ($user->role_id == '2') {
                activity()->causedBy(Auth::user())->log('User Mahasiswa ' . auth()->user()->nim . ' melakukan login');
                return redirect()->intended('home')->with('toast_success','Selamat, anda berhasil masuk.');
            }
        }
        return redirect('/')->with('toast_error','NIM atau Password yang dimasukkan tidak sesuai');
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('toast_success', 'Berhasil Keluar');
    }
}