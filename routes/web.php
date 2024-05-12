<?php

use App\Http\Controllers\AdminAgamaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AdminRolesController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\MahasiswaDashboardController;
use App\Http\Controllers\AdminProdiController;
use App\Http\Controllers\MahasiswaAkunController;
use App\Http\Controllers\MahasiswaDetailController;
use App\Http\Controllers\AdminDataMahasiswaController;
use App\Http\Controllers\AdminExportDataController;
use App\Http\Controllers\MahasiswaCetakKartuController;
use App\Http\Controllers\AdminJurusanController;
use App\Http\Controllers\AdminKelolaAkunController;
use App\Http\Controllers\AdminPengajuanController;
use App\Http\Controllers\AdminTahunAngkatanController;
use App\Http\Controllers\AdminUserImportController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\MahasiswaPengajuanController;
use App\Http\Controllers\QrProfileController;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Crypt;


//Login
Route::get('/', [SessionController::class, 'index'])->name('/');
Route::post('loginsession', [SessionController::class, 'login']);
//Logout
Route::post('logout', [SessionController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::middleware('CekUserLogin:1,3')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('kelolaakun', [AdminKelolaAkunController::class, 'index'])->name('kelolaakun.index');
        Route::post('kelolaakun/gantipassword', [AdminKelolaAkunController::class, 'changePassword'])->name('kelolaakun.gantipw');
        Route::post('/exportdata/exportexcel', [AdminExportDataController::class, 'exportexcel'])->name('exportdata.exportexcel');
        Route::post('/exportdata/exportimg', [AdminExportDataController::class, 'exportimg'])->name('exportdata.exportimg');
        Route::post('/exportdata/exportimgpengajuan', [AdminExportDataController::class, 'exportimgpengajuan'])->name('exportdata.exportimgpengajuan');
        Route::post('/exportdata/exportpengajuan', [AdminExportDataController::class, 'exportpengajuan'])->name('exportdata.exportpengajuan');
        Route::post('/import', [AdminUserImportController::class, 'import'])->name('import');
        Route::resource('tahunangkatan', AdminTahunAngkatanController::class);
        Route::resource('agama', AdminAgamaController::class);
        Route::resource('users/role', AdminRolesController::class);
        Route::resource('users/account', AdminUsersController::class);
        Route::resource('prodi', AdminProdiController::class);
        Route::resource('jurusan', AdminJurusanController::class);
        Route::resource('data-mahasiswa', AdminDataMahasiswaController::class);
        Route::resource('pengajuan', AdminPengajuanController::class);

        //Filtering Data
    });
    Route::middleware('CekUserLogin:2')->group(function () {
        Route::view('/isi-data', 'mahasiswa.data-diri.isi_data')->name('isi-data');
        Route::get('kartu-ktm', [MahasiswaCetakKartuController::class, 'index'])->name('kartu-ktm');
        Route::get('home', [MahasiswaDashboardController::class, 'index'])->name('home');
        Route::get('akun', [MahasiswaAkunController::class, 'index'])->name('akun.index');
        Route::get('/mahasiswa/{nim}', [MahasiswaDetailController::class, 'detail'])->name('mahasiswa.detail');
        Route::put('mahasiswa/update/{nim}', [MahasiswaDetailController::class, 'update'])->name('mahasiswa.update');
        Route::post('akun/gantiPassword', [MahasiswaAkunController::class, 'changePassword'])->name('akun.gantiPassword');
        Route::resource('pengajuanktm', MahasiswaPengajuanController::class);
    });
    Route::get('print-id/{mahasiswa}', function (Mahasiswa $mahasiswa) {
        $encryptedNim = Crypt::encrypt($mahasiswa->nim); // Mengenkripsi NIM mahasiswa
        return redirect()->route('print-id-encrypted', $encryptedNim);
    })->name('print-id');
    Route::get('printKTMe/{encryptedNim}', [PDFController::class, 'printIdEncrypted'])->name('print-id-encrypted');

    // Route::get('print-id/{mahasiswa}', [PDFController::class, 'printId'])->name('print-id');
    Route::post('getprovinsi', [WilayahController::class, 'getprovinsi'])->name('getprovinsi');
    Route::post('getkabupaten', [WilayahController::class, 'getkabupaten'])->name('getkabupaten');
    Route::post('getkecamatan', [WilayahController::class, 'getkecamatan'])->name('getkecamatan');

    Route::resource('kalender', KalenderController::class);

    Route::get('mahasiswa/profile/{encryptedNim}', [QrProfileController::class, 'index'])->name('qrprofile');
});