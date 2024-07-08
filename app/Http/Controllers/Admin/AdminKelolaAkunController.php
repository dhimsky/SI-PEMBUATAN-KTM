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
        $no_identitas = auth()->user()->no_identitas;
        $user = User::where('no_identitas', $no_identitas)->get();
        $role = Roles::all();
        return view('admin.kelolaakun.index', compact('role','user',));
    }
    public function update(Request $request){
        $user = Auth::user();
        $request->validate([
            'nama_lengkap' => 'required',
        ],[
            'nama_lengkap.required' => 'Isi nama anda!'
        ]);
        $user->update([
            'nama_lengkap' => $request->nama_lengkap
        ]);
        return redirect()->route('kelolaakun.index')->with('toast_success', 'Nama lengkap berhasil di ubah');
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
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->no_identitas . ' mengganti password');
        return redirect()->route('kelolaakun.index')->with('toast_success', 'Kata sandi berhasil di ubah');
    }
}