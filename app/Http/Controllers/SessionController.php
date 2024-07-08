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
                return redirect()->route('dashboard');
            } elseif ($user->role_id == '2') {
                return redirect()->route('home');
            }
        }
        return view('login');
    }
    function login(Request $request)
    {
        Session::flash('no_identitas', $request->input('no_identitas'));
    
        $request->validate([
            'no_identitas' => 'required',
            'password' => 'required',
        ],[
            'no_identitas.required' => 'masukan no_identitas',
            'password.required' => 'masukan password'
        ]);
    
        $credentials = $request->only('no_identitas', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role_id == '1' || $user->role_id == '3') {
                activity()->causedBy(Auth::user())->log('User ' . auth()->user()->no_identitas . ' melakukan login');
                return redirect()->route('dashboard')->with('toast_success','Selamat, anda berhasil masuk.');
            } elseif ($user->role_id == '2') {
                activity()->causedBy(Auth::user())->log('User ' . auth()->user()->no_identitas . ' melakukan login');
                return redirect()->route('home')->with('toast_success','Selamat, anda berhasil masuk.');
            }
        }
        return redirect('/')->with('toast_error','NIM atau Password yang dimasukkan tidak sesuai');
    }
    public function logout(Request $request) {
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->no_identitas . ' melakukan logout');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('toast_success', 'Berhasil Keluar');
    }
}