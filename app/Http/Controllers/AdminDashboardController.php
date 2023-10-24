<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index () {
        $accountCount = User::where('role_id', '2')->count();
        $mahasiswaCount = Mahasiswa::count();
        $notcompleteCount = $accountCount - $mahasiswaCount;

        $KedungrejaCount = Mahasiswa::where('kecamatan','33.01.01')->count();
        $KesugihanCount = Mahasiswa::where('kecamatan','33.01.02')->count();
        $AdipalaCount = Mahasiswa::where('kecamatan','33.01.03')->count();
        $BinangunCount = Mahasiswa::where('kecamatan','33.01.04')->count();
        $NusawunguCount = Mahasiswa::where('kecamatan','33.01.05')->count();
        $KroyaCount = Mahasiswa::where('kecamatan','33.01.06')->count();
        $MaosCount = Mahasiswa::where('kecamatan','33.01.07')->count();
        $JeruklegiCount = Mahasiswa::where('kecamatan','33.01.08')->count();
        $KawungantenCount = Mahasiswa::where('kecamatan','33.01.09')->count();
        $GandrungmanguCount = Mahasiswa::where('kecamatan','33.01.10')->count();
        $SidarejaCount = Mahasiswa::where('kecamatan','33.01.11')->count();
        $KarangpucungCount = Mahasiswa::where('kecamatan','33.01.12')->count();
        $CimangguCount = Mahasiswa::where('kecamatan','33.01.13')->count();
        $MajenangCount = Mahasiswa::where('kecamatan','33.01.14')->count();
        $WanarejaCount = Mahasiswa::where('kecamatan','33.01.15')->count();
        $DayeuhluhurCount = Mahasiswa::where('kecamatan','33.01.16')->count();
        $SampangCount = Mahasiswa::where('kecamatan','33.01.17')->count();
        $CipariCount = Mahasiswa::where('kecamatan','33.01.18')->count();
        $PatimuanCount = Mahasiswa::where('kecamatan','33.01.19')->count();
        $BantasariCount = Mahasiswa::where('kecamatan','33.01.20')->count();
        $CilacapselatanCount = Mahasiswa::where('kecamatan','33.01.21')->count();
        $CilacaptengahCount = Mahasiswa::where('kecamatan','33.01.22')->count();
        $CilacaputaraCount = Mahasiswa::where('kecamatan','33.01.23')->count();
        $KampunglautCount = Mahasiswa::where('kecamatan','33.01.24')->count();

        return view('admin.dashboard.index', compact('accountCount', 'mahasiswaCount', 'notcompleteCount','KedungrejaCount', 'KesugihanCount', 'AdipalaCount',
        'BinangunCount', 'NusawunguCount', 'KroyaCount',
        'MaosCount', 'JeruklegiCount', 'KawungantenCount',
        'GandrungmanguCount', 'SidarejaCount', 'KarangpucungCount',
        'CimangguCount', 'MajenangCount', 'WanarejaCount',
        'DayeuhluhurCount', 'SampangCount', 'CipariCount',
        'PatimuanCount', 'BantasariCount', 'CilacapselatanCount',
        'CilacaptengahCount', 'CilacaputaraCount', 'KampunglautCount'));
    }
}