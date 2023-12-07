<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Kalender;
use Illuminate\Support\Facades\DB;

class KalenderController extends Controller
{
    public $sources = [
        [
            'model'      => Kalender::class,
            'date_field' => 'tanggal',
            'field'      => ['prodi','kelas'],
        ],
    ];
    public function index () {
        $jadwal = [];
        $prodi = Prodi::all();
        $prodi2 = DB::table('prodi')->get();

        $kalender = Kalender::all();

        foreach ($this->sources as $source) {
            $models = $source['model']::get();

            foreach ($models as $model) {
                $crudFieldValue = $model->{$source['date_field']};
                $title = '';
                foreach ($source['field'] as $field) {
                    $title .= $model->{$field} . ' ';
                }
                $title = trim($title);
                $jadwal[] = [
                    'title' => $title,
                    'start' => $crudFieldValue,
                ];
            }
        }

        $title = 'Hapus Prodi!';
        $text = "Yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
        
        return view('kalender.index', compact('prodi', 'kalender', 'jadwal', 'prodi2'));
    }

    public function store (Request $request) {
        $request->validate([
            'tanggal' => 'required',
            'jam' => 'required',
            'prodi' => 'required',
            'kelas' => 'required',
        ],[
            'tanggal.required' => 'Tanggal wajib diisi!',
            'jam.required' => 'Jam wajib diisi!',
            'prodi.required' => 'Prodi wajib diisi!',
            'kelas.required' => 'Kelas wajib diisi!'
        ]);

        Kalender::create([
            'tanggal' => $request->input('tanggal'),
            'jam' => $request->input('jam'),
            'prodi' => $request->input('prodi'),
            'kelas' => $request->input('kelas'),
            'detail' => $request->input('detail'),
        ]);

        return redirect()->route('kalender.index')->with('success', 'Berhasil ditambahkan dalam kalender.');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'tanggal' => 'required',
            'jam' => 'required',
            'prodi' => 'required',
            'kelas' => 'required',
        ]);

        $kalender = Kalender::find($id);
        $kalender->tanggal = $request->input('tanggal');
        $kalender->jam = $request->input('jam');
        $kalender->prodi = $request->input('prodi');
        $kalender->kelas = $request->input('kelas');
        $kalender->detail = $request->input('detail');
        $kalender->save();

        return redirect()->route('kalender.index')->with('success', 'Kalender berhasil diupdate.');
    }

    public function destroy($id) {
        $kalender = Kalender::find($id);
        $kalender->delete();

        return redirect()->route('kalender.index')->with('success', 'Kalender berhasil dihapus.');
    }
}