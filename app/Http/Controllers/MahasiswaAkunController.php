<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\Mahasiswa;

class MahasiswaAkunController extends Controller
{
    public function index()
    {
        $nim = auth()->user()->nim; // Mendapatkan email pengguna yang sedang login
        $user = User::where('nim', $nim)->get(); // Mengambil data user berdasarkan email
        $role = Roles::all();
        $mahasiswa = Mahasiswa::all();

        return view('mahasiswa.akun.index', compact('user','role','mahasiswa'));
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

        return redirect()->route('akun.index')->with('toast_success', 'Kata sandi berhasil di ubah');
    }
}