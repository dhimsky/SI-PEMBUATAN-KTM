<?php

use App\Http\Controllers\Admin\AdminAgamaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminRolesController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Mahasiswa\MahasiswaDashboardController;
use App\Http\Controllers\Admin\AdminProdiController;
use App\Http\Controllers\Mahasiswa\MahasiswaAkunController;
use App\Http\Controllers\Mahasiswa\MahasiswaDetailController;
use App\Http\Controllers\Admin\AdminDataMahasiswaController;
use App\Http\Controllers\Admin\AdminExportDataController;
use App\Http\Controllers\Mahasiswa\MahasiswaCetakKartuController;
use App\Http\Controllers\Admin\AdminJurusanController;
use App\Http\Controllers\Admin\AdminKelolaAkunController;
use App\Http\Controllers\Admin\AdminPengajuanController;
use App\Http\Controllers\Admin\AdminTahunAngkatanController;
use App\Http\Controllers\Admin\AdminUserImportController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\Mahasiswa\MahasiswaPengajuanController;
use App\Http\Controllers\QrProfileController;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Crypt;


//Login
Route::get('/', [SessionController::class, 'index'])->name('/');
Route::post('/loginsession', [SessionController::class, 'login']);
//Logout
Route::post('/logout', [SessionController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware('CekUserLogin:1,3')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/kelolaakun', [AdminKelolaAkunController::class, 'index'])->name('kelolaakun.index');
        Route::post('/kelolaakun/gantipassword', [AdminKelolaAkunController::class, 'changePassword'])->name('kelolaakun.gantipw');
        Route::post('/kelolaakun/gantinama', [AdminKelolaAkunController::class, 'update'])->name('kelolaakun.gantinama');
        Route::post('/exportdata/exportexcel', [AdminExportDataController::class, 'exportexcel'])->name('exportdata.exportexcel');
        Route::post('/exportdata/exportimg', [AdminExportDataController::class, 'exportimg'])->name('exportdata.exportimg');
        Route::post('/exportdata/exportimgpengajuan', [AdminExportDataController::class, 'exportimgpengajuan'])->name('exportdata.exportimgpengajuan');
        Route::post('/exportdata/exportpengajuan', [AdminExportDataController::class, 'exportpengajuan'])->name('exportdata.exportpengajuan');
        Route::post('/import', [AdminUserImportController::class, 'import'])->name('import');
        Route::resource('/tahunangkatan', AdminTahunAngkatanController::class);
        Route::resource('/agama', AdminAgamaController::class);
        Route::resource('/role', AdminRolesController::class);
        Route::resource('/account', AdminUsersController::class);
        Route::resource('/prodi', AdminProdiController::class);
        Route::resource('/jurusan', AdminJurusanController::class);
        Route::resource('/data-mahasiswa', AdminDataMahasiswaController::class);
        Route::post('/data-mahasiswa/update-status', [AdminDataMahasiswaController::class, 'updateStatusMhs'])->name('mahasiswa.update-status');
        Route::resource('/pengajuan', AdminPengajuanController::class);
        Route::post('/pengajuan/update-status', [AdminPengajuanController::class, 'updateStatusPengajuan'])->name('pengajuan.update-status');
    });
    Route::prefix('mahasiswa')->middleware('CekUserLogin:2')->group(function () {
        Route::view('/isi-data', 'mahasiswa.data-diri.isi_data')->name('isi-data');
        Route::get('/kartu-ktm', [MahasiswaCetakKartuController::class, 'index'])->name('kartu-ktm');
        Route::get('/home', [MahasiswaDashboardController::class, 'index'])->name('home');
        Route::get('/akun', [MahasiswaAkunController::class, 'index'])->name('akun.index');
        Route::get('/{nim}', [MahasiswaDetailController::class, 'detail'])->name('mahasiswa.detail');
        Route::put('/update/{nim}', [MahasiswaDetailController::class, 'update'])->name('mahasiswa.update');
        Route::get('/pengajuanktm/{nim}', [MahasiswaPengajuanController::class, 'index'])->name('pengajuanktm.index');
        Route::post('/pengajuanktm/tambah', [MahasiswaPengajuanController::class, 'store'])->name('pengajuanktm.store');
        Route::delete('/pengajuanktm/hapus/{nim}', [MahasiswaPengajuanController::class, 'destroy'])->name('pengajuanktm.destroy');
        Route::put('/pengajuanktm/selesai', [MahasiswaPengajuanController::class, 'terimaKTM'])->name('pengajuanktm.selesai');
        Route::post('/akun/gantiPassword', [MahasiswaAkunController::class, 'changePassword'])->name('akun.gantiPassword');
    });

    Route::get('print-id/{mahasiswa}', function (Mahasiswa $mahasiswa) {
        $encryptedNim = Crypt::encrypt($mahasiswa->nim); // Mengenkripsi NIM mahasiswa
        return redirect()->route('print-id-encrypted', $encryptedNim);
    })->name('print-id');
    Route::get('/printEKTM/{encryptedNim}', [PDFController::class, 'printIdEncrypted'])->name('print-id-encrypted');

    Route::post('getprovinsi', [WilayahController::class, 'getprovinsi'])->name('getprovinsi');
    Route::post('getkabupaten', [WilayahController::class, 'getkabupaten'])->name('getkabupaten');
    Route::post('getkecamatan', [WilayahController::class, 'getkecamatan'])->name('getkecamatan');

    Route::resource('/kalender', KalenderController::class);
});
Route::get('/mahasiswa/profile/{encryptedNim}', [QrProfileController::class, 'index'])->name('qrprofile');