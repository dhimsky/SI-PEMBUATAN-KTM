<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use App\Models\Jurusan;
use Illuminate\Validation\Rule;

class AdminProdiController extends Controller
{
    public function index(Request $request)
    {
        $jurusan = Jurusan::all();
        $prodi = Prodi::orderBy('created_at', 'desc')->get();

        $title = 'Hapus Prodi!';
        $text = "Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
        
        return view('admin.prodi.index', compact('prodi', 'jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_prodi' => 'required|unique:prodi,id_prodi',
            'jurusan_id' => 'required',
            'nama_prodi' => 'required',
            'jenjang' => 'required',
        ],[
            'id_prodi.required' => 'Kode tidak boleh kosong!',
            'id_prodi.unique' => 'Kode sudah digunakan, pakai yang lain!',
            'jurusan_id.required'=> 'Pilih salah satu Jurusan!',
            'nama_prodi.required' => 'Nama Prodi tidak boleh kosong!',
            'jenjang.required' => 'Jenjang tidak boleh kosong!',
        ]);
        
        Prodi::create([
            'id_prodi' => $request->input('id_prodi'),
            'nama_prodi' => $request->input('nama_prodi'),
            'jurusan_id' => $request->input('jurusan_id'),
            'jenjang' => $request->input('jenjang'),
        ]);

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_prodi' => [
                'required',
                Rule::unique('prodi')->ignore($id, 'id_prodi')
            ],
            'jurusan_id' => 'required',
            'nama_prodi' => 'required',
            'jenjang' => 'required',
        ],[
            'id_prodi.required' => 'Kode tidak boleh kosong!',
            'jurusan_id.required'=> 'Pilih salah satu Jurusan!',
            'id_prodi.unique' => 'Kode sudah digunakan, pakai yang lain!',
            'nama_prodi.required' => 'Nama Prodi tidak boleh kosong!',
            'jenjang.required' => 'Jenjang tidak boleh kosong!',
        ]);

        $prodi = Prodi::find($id);
        $prodi->id_prodi = $request->input('id_prodi');
        $prodi->nama_prodi = $request->input('nama_prodi');
        $prodi->jurusan_id = $request->input('jurusan_id');
        $prodi->jenjang = $request->input('jenjang');
        $prodi->save();

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil diupdate');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::where('prodi_id', $id)->first();
        if (!$mahasiswa) {
            $prodi = Prodi::find($id);
            $prodi->delete();
            return redirect()->route('prodi.index')->with('success', 'Prodi berhasil dihapus.');
        } else {
            return redirect()->route('prodi.index')->with('error', 'Tidak dapat menghapus!, Prodi sedang digunakan oleh tabel Mahasiswa.');
        }
    }
}