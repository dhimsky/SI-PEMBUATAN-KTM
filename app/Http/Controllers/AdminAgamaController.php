<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Mahasiswa;

class AdminAgamaController extends Controller
{
    public function index(Request $request){
        $agama = Agama::all();
    
        $title = 'Hapus Agama!';
        $text = "Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
    
        return view ('admin.agama.index', compact('agama'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_agama' => 'required|unique:agama,id_agama',
            'nama_agama' => 'required',
        ],[
            'id_agama.required' => 'Kode tidak boleh kosong!',
            'id_agama.unique' => 'Kode sudah digunakan, pakai yang lain!',
            'nama_agama.required' => 'Agama tidak boleh kosong!',
        ]);
        $agama = new Agama;
        $agama->id_agama =  $request->input('id_agama');
        $agama->nama_agama =  $request->input('nama_agama');
        $agama->save();
        return redirect()->route('agama.index')->with('success', 'Agama berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_agama' => [
                'required',
                Rule::unique('agama')->ignore($id, 'id_agama')
            ],
            'nama_agama' => 'required',
        ], [
            'id_agama.required' => 'Kode tidak boleh kosong!',
            'nama_agama.required' => 'Agama wajib diisi!',
        ]);

        $agama = Agama::find($id);
        $agama->id_agama =  $request->input('id_agama');
        $agama->nama_agama =  $request->input('nama_agama');
        $agama->save();
        return redirect()->route('agama.index')->with('success', 'Agama berhasil diupdate.');
    }
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('agama_id', $id)->first();
        if (!$mahasiswa){
            $agama = Agama::find($id);
            $agama->delete();
            return redirect()->route('agama.index')->with('success', 'Agama berhasil dihapus.');
        }else{
            return redirect()->route('agama.index')->with('error','Tidak dapat menghapus!, agama sedang digunakan pada tabel Mahasiswa.');
        }
    }
}