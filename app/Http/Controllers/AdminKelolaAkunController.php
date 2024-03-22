<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;

class AdminKelolaAkunController extends Controller
{
    public function index(){
        $nim = auth()->user()->nim;
        $user = User::where('nim', $nim)->get();
        $role = Roles::all();
        return view('admin.kelolaakun.index', compact('role','user',));
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('akun.index')->withErrors(['current_password' => 'Password lama yang anda masukan salah!']);
        }
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->route('kelolaakun.index')->with('toast_success', 'Kata sandi berhasil di ubah');
    }
}