<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Session;

class AdminProdiController extends Controller
{
    public function index(Request $request)
    {
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();

        $title = 'Hapus Prodi!';
        $text = "Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
        
        return view('admin.prodi.index', compact('prodi', 'jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required',
            'jurusan_id' => 'required',
        ],[
            'nama_prodi.required' => 'Nama Prodi tidak boleh kosong!',
            'jurusan_id.required'=> 'Pilih salah satu Jurusan!',
        ]);

        Prodi::create([
            'nama_prodi' => $request->input('nama_prodi'),
            'jurusan_id' => $request->input('jurusan_id'),
        ]);

        return redirect()->route('prodi.index')->with('success', 'Prodi berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_prodi' => 'required',
        ],[
            'nama_prodi.required' => 'Nama Prodi tidak boleh kosong!',
        ]);

        $prodi = Prodi::find($id);
        $prodi->nama_prodi = $request->input('nama_prodi');
        $prodi->jurusan_id = $request->input('jurusan_id');
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