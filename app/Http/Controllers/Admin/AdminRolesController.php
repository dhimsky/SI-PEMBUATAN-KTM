<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Roles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminRolesController extends Controller
{
    public function index(Request $request)
    {
        $role = Roles::all();
        return view('admin.datapengguna.role.index',compact('role'));
    }
    public function edit($id)
    {
        $role = Roles::find($id);
        return view('admin.role.edit', compact('role'));
    }
    public function update(Request $request, $id)
    {
        $role = Roles::find($id);
        $role->level =  $request->input('level');
        $role->save();
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->nim . ' melakukan update roles');
        return redirect()->route('role.index')->with('toast_success', 'Tabel Role berhasil diupdate');
    }
    // public function destroy($id)
    // {
    //     $users = User::all();
    //     $idrole = DB::table('users')
    //         ->where('role_id', $id)
    //         ->value('role_id');
    //     if ($idrole == NULL){
    //         $role = Roles::find($id);
    //         $role->delete();
    //         return redirect()->route('role.index')->with('success', 'role berhasil dihapus');
    //     }else{
    //         return redirect()->route('role.index')->with('eror','Tidak dapat menghapus!, role sedang digunakan pada user');
    //     }
    // }
}