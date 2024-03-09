<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\TahunAngkatan;
use Illuminate\Validation\Rule;

class AdminTahunAngkatanController extends Controller
{
    public function index(Request $request){
        $tahunangkatan = TahunAngkatan::all();
    
        $title = 'Hapus Tahun Angkatan!';
        $text = "Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
    
        return view ('admin.tahunangkatan.index', compact('tahunangkatan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_angkatan' => 'required|unique:tahunangkatan,id_angkatan',
            'tahun_angkatan' => 'required',
        ],[
            'id_angkatan.required' => 'Kode tidak boleh kosong!',
            'id_angkatan.unique' => 'Kode sudah digunakan, pakai yang lain!',
            'tahun_angkatan.required' => 'Nama tahun angkatan tidak boleh kosong!',
        ]);
        $tahunangkatan = new TahunAngkatan;
        $tahunangkatan->id_angkatan =  $request->input('id_angkatan');
        $tahunangkatan->tahun_angkatan =  $request->input('tahun_angkatan');
        $tahunangkatan->save();
        return redirect()->route('tahunangkatan.index')->with('success', 'Tahun angkatan berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_angkatan' => [
                'required',
                Rule::unique('tahunangkatan')->ignore($id, 'id_angkatan')
            ],
            'tahun_angkatan' => 'required',
        ], [
            'id_angkatan.required' => 'Kode tidak boleh kosong!',
            'tahun_angkatan.required' => 'Tahun Angkatan wajib diisi!',
        ]);

        $tahunangkatan = TahunAngkatan::find($id);
        $tahunangkatan->id_angkatan =  $request->input('id_angkatan');
        $tahunangkatan->tahun_angkatan =  $request->input('tahun_angkatan');
        $tahunangkatan->save();
        return redirect()->route('tahunangkatan.index')->with('success', 'Tahun angkatan berhasil diupdate.');
    }
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('angkatan_id', $id)->first();
        if (!$mahasiswa){
            $tahunangkatan = TahunAngkatan::find($id);
            $tahunangkatan->delete();
            return redirect()->route('tahunangkatan.index')->with('success', 'Tahun angkatan berhasil dihapus.');
        }else{
            return redirect()->route('tahunangkatan.index')->with('error','Tidak dapat menghapus!, tahun angkatan sedang digunakan pada tabel Mahasiswa.');
        }
    }
}