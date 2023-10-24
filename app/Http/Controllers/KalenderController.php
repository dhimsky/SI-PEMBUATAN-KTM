<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Kalender;

class KalenderController extends Controller
{
    public $sources = [
        [
            'model'      => Kalender::class,
            'date_field' => 'tanggal',
            'field'      => ['prodi','kelas','jam'],
        ],
    ];
    public function index () {
        $jadwal = [];
        $prodi = Prodi::all();
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

        return view('kalender.index', compact('prodi', 'kalender', 'jadwal'));
    }

    public function store (Request $request) {
        $request->validate([
            'tanggal' => 'required',
            'jam' => 'required',
            'prodi' => 'required',
            'kelas' => 'required',
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