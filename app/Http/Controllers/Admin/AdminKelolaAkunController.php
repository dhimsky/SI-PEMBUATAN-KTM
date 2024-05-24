<?php

namespace App\Http\Controllers\Admin;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->nim . ' mengganti password');
        return redirect()->route('kelolaakun.index')->with('toast_success', 'Kata sandi berhasil di ubah');
    }
}