<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\TahunAngkatan;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminTahunAngkatanController extends Controller
{
    public function index(Request $request){
        $tahunangkatan = TahunAngkatan::all();
    
        $title = 'Hapus Tahun Angkatan!';
        $text = "Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
    
        return view ('admin.dataform.tahunangkatan.index', compact('tahunangkatan'));
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
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->no_identitas . ' menambah tahun angkatan');
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
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->no_identitas . ' mengubah tabel tahun angkatan');
        return redirect()->route('tahunangkatan.index')->with('success', 'Tahun angkatan berhasil diupdate.');
    }
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('angkatan_id', $id)->first();
        if (!$mahasiswa){
            $tahunangkatan = TahunAngkatan::find($id);
            $tahunangkatan->delete();
            activity()->causedBy(Auth::user())->log('User ' . auth()->user()->no_identitas . ' menghapus tahun angkatan');
            return redirect()->route('tahunangkatan.index')->with('success', 'Tahun angkatan berhasil dihapus.');
        }else{
            return redirect()->route('tahunangkatan.index')->with('error','Tidak dapat menghapus!, tahun angkatan sedang digunakan pada tabel Mahasiswa.');
        }
    }
}