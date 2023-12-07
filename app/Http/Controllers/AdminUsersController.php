<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUsersController extends Controller
{
    public function index(Request $request)
    {
        $role = Roles::all();
        $users = User::with('role')->whereIn('role_id',['2','3'])->get();
        
        $title = 'Hapus User!';
        $text = "Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
    
        return view('admin.users.index', compact('users','role'));
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
        Session::flash('password', $request->input('password'));

        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim',
            'username' => 'required',
            'password' => 'required|min:8',
            'role_id' => 'required'
        ], [
            'nim.required' => 'Nama wajib diisi!',
            'nim.unique' =>'NIM sudah terdaftar!',
            'role_id.required' => 'Level wajib diisi!',
            'username.required' => 'Username wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Minumum password 8 karakter!',
        ]);
        
        $data = [
            'nim' => $request->nim,
            'role_id' => $request->role_id,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ];
        User::create($data);
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
    $user->save();

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
            return redirect()->route('account.index')->with('success', 'Account berhasil di Hapus.');
        }else{
            return redirect()->route('account.index')->with('error', 'Tidak dapat menghapus!, Account sedang digunakan pada tabel Mahasiswa.');
        }
    }
}