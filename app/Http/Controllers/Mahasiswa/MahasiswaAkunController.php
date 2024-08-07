<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\Mahasiswa;
use App\Http\Controllers\Controller;

class MahasiswaAkunController extends Controller
{
    public function index()
    {
        $nim = auth()->user()->no_identitas; // Mendapatkan email pengguna yang sedang login
        $user = User::where('no_identitas', $nim)->get(); // Mengambil data user berdasarkan email
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
        activity()->causedBy(Auth::user())->log('Mahasiswa ' . auth()->user()->no_identitas . ' mengganti password');
        return redirect()->route('akun.index')->with('toast_success', 'Kata sandi berhasil di ubah');
    }
}