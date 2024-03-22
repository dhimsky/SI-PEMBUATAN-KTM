<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class AdminPengajuanController extends Controller
{
    public function index(){
        $pengajuan = Pengajuan::all();

        $title = 'Hapus Pengajuan!';
        $text = "Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);

        return view('admin.pengajuan.index', compact('pengajuan'));
    }

    public function store(Request $request){
        $request->validate([
            'nim_id' => 'required|exists:mahasiswa,nim',
            'status' => 'required',
        ],[
            'nim_id.required' => 'NIM wajib diisi!',
            'nim_id.exists' => 'NIM tidak ditemukan dalam tabel Mahasiswa!',
            'status.required' => 'Status wajib diisi!',
        ]);

        Pengajuan::create([
            'nim_id' => $request->input('nim_id'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('pengajuan.index')->with('success', 'Berhasil ditambahkan dalam pengajuan.');
    }

    public function update(Request $request, $id){
        $request->validate([
            'nim_id' => 'required|exists:mahasiswa,nim',
            'status' => 'required',
        ],[
            'nim_id.required' => 'NIM wajib diisi!',
            'nim_id.exists' => 'NIM tidak ditemukan dalam tabel Mahasiswa!',
            'status.required' => 'Status wajib diisi!',
        ]);

        $pengajuan = Pengajuan::find($id);
        $pengajuan->nim_id = $request->input('nim_id');
        $pengajuan->status = $request->input('status');
        $pengajuan->save();

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil di update.');
    }

    public function destroy($id){
        $pengajuan = Pengajuan::find($id);
        $pengajuan->delete();

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil dihapus.');
    }
}