<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\Prodi;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminJurusanController extends Controller
{
    public function index(Request $request)
    {
        $jurusan = Jurusan::all();
        
        $title = 'Hapus Jurusan!';
        $text = "Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);

        return view('admin.dataform.jurusan.index',compact('jurusan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_jurusan' => 'required|unique:jurusan,id_jurusan',
            'nama_jurusan' => 'required',
        ],[
            'id_jurusan.required' => 'Kode tidak boleh kosong!',
            'id_jurusan.unique' => 'Kode sudah digunakan, pakai yang lain!',
            'nama_jurusan.required' => 'Nama Jurusan tidak boleh kosong!',
        ]);
        $jurusan = new Jurusan;
        $jurusan->id_jurusan =  $request->input('id_jurusan');
        $jurusan->nama_jurusan =  $request->input('nama_jurusan');
        $jurusan->save();
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->no_identitas . ' menambah jurusan');
        return redirect()->route('jurusan.index')->with('success', 'jurusan berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_jurusan' => [
                'required',
                Rule::unique('jurusan')->ignore($id, 'id_jurusan')
            ],
            'nama_jurusan' => 'required',
        ], [
            'id_jurusan.required' => 'Kode tidak boleh kosong!',
            'nama_jurusan.required' => 'Nama Jurusan wajib diisi!',
        ]);

        $jurusan = Jurusan::find($id);
        $jurusan->id_jurusan =  $request->input('id_jurusan');
        $jurusan->nama_jurusan =  $request->input('nama_jurusan');
        $jurusan->save();
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->no_identitas . ' mengubah data jurusan');
        return redirect()->route('jurusan.index')->with('success', 'jurusan berhasil diupdate');
    }
    public function destroy($id)
    {
        $prodi = Prodi::where('jurusan_id', $id)->first();
        if (!$prodi){
            $jurusan = Jurusan::find($id);
            $jurusan->delete();
            activity()->causedBy(Auth::user())->log('User ' . auth()->user()->no_identitas . ' menghapus jurusan');
            return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus.');
        }else{
            return redirect()->route('jurusan.index')->with('error','Tidak dapat menghapus!, Jurusan sedang digunakan pada tabel Prodi.');        }
    }
}