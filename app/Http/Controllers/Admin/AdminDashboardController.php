<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index (Request $request) {
        $accountCount = User::where('role_id', '2')->count();
        $mahasiswaCount = Mahasiswa::count();
        $notcompleteCount = $accountCount - $mahasiswaCount;
        $mahasiswaActive = Mahasiswa::where('status_mhs', 'Aktif')->count();
        $mahasiswaNonActive = Mahasiswa::where('status_mhs', 'Tidak aktif')->count();
        $pengajuan = Pengajuan::count();
        $selesai = Pengajuan::where('status', 'selesai')->count();
        $proses = Pengajuan::where('status', 'proses')->count();
        $buatulang = Pengajuan::where('status', 'pembuatan ulang')->count();

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

        $log = Activity::latest()->paginate();

        return view('admin.dashboard.index', compact('mahasiswaNonActive', 'mahasiswaActive', 'accountCount', 'mahasiswaCount', 'notcompleteCount', 'pengajuan', 'selesai', 'proses', 'buatulang' ,'KedungrejaCount', 'KesugihanCount', 'AdipalaCount',
        'BinangunCount', 'NusawunguCount', 'KroyaCount',
        'MaosCount', 'JeruklegiCount', 'KawungantenCount',
        'GandrungmanguCount', 'SidarejaCount', 'KarangpucungCount',
        'CimangguCount', 'MajenangCount', 'WanarejaCount',
        'DayeuhluhurCount', 'SampangCount', 'CipariCount',
        'PatimuanCount', 'BantasariCount', 'CilacapselatanCount',
        'CilacaptengahCount', 'CilacaputaraCount', 'KampunglautCount'), ['models' => $log]);
    }
}