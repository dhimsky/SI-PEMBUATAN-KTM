<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminUsersController extends Controller
{
    public function index(Request $request)
    {
        $role = Roles::all();
        $users = User::with('role')->whereIn('role_id',['2','3'])->get();
        
        $title = 'Hapus User!';
        $text = "Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
    
        return view('admin.datapengguna.users.index', compact('users','role'));
    }
    
    public function create()
    {
        $role = Roles::all();
        return view('admin.users.create', compact('role'));
    }
    public function store(Request $request)
    {
        Session::flash('nim', $request->input('nim'));
        Session::flash('role_id', $request->input('role_id'));
        Session::flash('username', $request->input('username'));

        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'username' => 'required',
            'role_id' => 'required'
        ], [
            'nim.required' => 'Nama wajib diisi!',
            'nim.unique' =>'NIM sudah terdaftar!',
            'role_id.required' => 'Level wajib diisi!',
            'username.required' => 'Username wajib diisi!',
        ]);
        
        $data = [
            'nim' => $request->nim,
            'role_id' => $request->role_id,
            'username' => $request->username,
            'password' => Hash::make('abcd1234'),
        ];
        User::create($data);
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->nim . ' menambahkan akun');
        return redirect()->route('account.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $role = Roles::all();
        $users = User::with('role')->find($id);
        return view('admin.users.edit', compact('users', 'role'));
    }

public function update(Request $request, $id)
{
    $request->validate([
        'nim' => 'required',
        'username' => 'required',
        'role_id' => 'required',
    ], [
        'nim.required' => 'NIM wajib diisi!',
        'username.required' => 'Username wajib diisi!',
        'role_id.required' => 'Role wajib diisi!',
    ]);

    $user = User::find($id);
    
    if (!$user) {
        return redirect()->route('account.index')->with('error', 'User tidak ditemukan');
    }

    $user->nim = $request->input('nim');
    $user->username = $request->input('username');
    $user->role_id = $request->input('role_id');
    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }
    $user->save();
    activity()->causedBy(Auth::user())->log('User ' . auth()->user()->nim . ' mengubah tabel akun');
    return redirect()->route('account.index')->with('success', 'Account berhasil diupdate');
}

    public function destroy($id)
    {
        $idUsers = DB::table('mahasiswa')
            ->where('nim', $id)
            ->value('nim');
        if ($idUsers == NULL){
            $users = User::find($id);
            $users->delete();
            activity()->causedBy(Auth::user())->log('User ' . auth()->user()->nim . ' menghapus akun');
            return redirect()->route('account.index')->with('success', 'Account berhasil di Hapus.');
        }else{
            return redirect()->route('account.index')->with('error', 'Tidak dapat menghapus!, Account sedang digunakan pada tabel Mahasiswa.');
        }
    }
}