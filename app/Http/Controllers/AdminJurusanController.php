<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Support\Facades\DB;

class AdminJurusanController extends Controller
{
    public function index(Request $request)
    {
        $jurusan = Jurusan::all();
        
        $title = 'Hapus Jurusan!';
        $text = "Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);

        return view('admin.jurusan.index',compact('jurusan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required',
        ],[
            'nama_jurusan.required' => 'Nama Jurusan tidak boleh kosong!',
        ]);
        $jurusan = new Jurusan;
        $jurusan->nama_jurusan =  $request->input('nama_jurusan');
        $jurusan->save();
        return redirect()->route('jurusan.index')->with('success', 'jurusan berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jurusan' => 'required',
        ], [
            'nama_jurusan.required' => 'Nama Jurusan wajib diisi!',
        ]);

        $jurusan = Jurusan::find($id);
        $jurusan->nama_jurusan =  $request->input('nama_jurusan');
        $jurusan->save();
        return redirect()->route('jurusan.index')->with('success', 'jurusan berhasil diupdate');
    }
    public function destroy($id)
    {
        $idjurusan = DB::table('prodi')
            ->where('jurusan_id', $id)
            ->value('jurusan_id');
        if ($idjurusan == NULL){
            $jurusan = jurusan::find($id);
            $jurusan->delete();
            return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus.');
        }else{
            return redirect()->route('jurusan.index')->with('error','Tidak dapat menghapus!, Jurusan sedang digunakan pada tabel Prodi.');        }
    }
}