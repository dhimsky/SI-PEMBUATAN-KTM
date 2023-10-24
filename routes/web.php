<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\MahasiswaController;
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
use App\Http\Controllers\PDFController;
use App\Http\Controllers\KalenderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Login
Route::get('/', [SessionController::class, 'index'])->name('/');
Route::post('loginsession', [SessionController::class, 'login']);
//Logout
Route::post('logout', [SessionController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    
    Route::middleware('CekUserLogin:1')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('users/role', AdminRolesController::class);
        Route::resource('users/account', AdminUsersController::class);
        // Route::get('deleteaccount{id}', [AdminUsersController::class, 'destroy'] )->name('destroyaccount');
        Route::resource('prodi', AdminProdiController::class);
        Route::resource('jurusan', AdminJurusanController::class);
        Route::resource('data-mahasiswa', AdminDataMahasiswaController::class);
        Route::get('/exportdata/exportexcel', [AdminExportDataController::class, 'exportexcel'])->name('exportdata.exportexcel');
    });
    Route::middleware('CekUserLogin:2')->group(function () {
        Route::get('kartu-ktm', [MahasiswaCetakKartuController::class, 'index'])->name('kartu-ktm');
        Route::get('home', [MahasiswaDashboardController::class, 'index'])->name('home');
        Route::get('akun', [MahasiswaAkunController::class, 'index'])->name('akun.index');
        Route::post('akun/gantiPassword', [MahasiswaAkunController::class, 'changePassword'])->name('akun.gantiPassword');

        // Mahasiswa Wizard Step 1
        Route::get('/mahasiswa/step1', [MahasiswaController::class, 'step1'])->name('mahasiswa.isi_data.step1');
        Route::post('/mahasiswa/step1', [MahasiswaController::class, 'step1Store'])->name('mahasiswa.isi_data.step1.store');
        // Mahasiswa Wizard Step 2
        Route::get('/mahasiswa/step2', [MahasiswaController::class, 'step2'])->name('mahasiswa.isi_data.step2');
        Route::post('/mahasiswa/step2', [MahasiswaController::class, 'step2Store'])->name('mahasiswa.isi_data.step2.store');
        // Mahasiswa Wizard Step 3
        Route::get('/mahasiswa/step3', [MahasiswaController::class, 'step3'])->name('mahasiswa.isi_data.step3');
        Route::post('/mahasiswa/step3', [MahasiswaController::class, 'step3Store'])->name('mahasiswa.isi_data.step3.store');
        // Mahasiswa Wizard Step 4
        Route::get('/mahasiswa/step4', [MahasiswaController::class, 'step4'])->name('mahasiswa.isi_data.step4');
        Route::post('/mahasiswa/step4', [MahasiswaController::class, 'step4Store'])->name('mahasiswa.isi_data.step4.store');
        // Mahasiswa Wizard Step 5
        Route::get('/mahasiswa/step5', [MahasiswaController::class, 'step5'])->name('mahasiswa.isi_data.step5');
        Route::post('/mahasiswa/step5', [MahasiswaController::class, 'step5Store'])->name('mahasiswa.isi_data.step5.store');
        // Mahasiswa Wizard Step 6
        Route::get('/mahasiswa/step6', [MahasiswaController::class, 'step6'])->name('mahasiswa.isi_data.step6');
        Route::post('/mahasiswa/step6', [MahasiswaController::class, 'step6Store'])->name('mahasiswa.isi_data.step6.store');

        Route::get('/mahasiswa/{nim}', [MahasiswaDetailController::class, 'detail'])->name('mahasiswa.detail');
        Route::put('mahasiswa/update/{nim}', [MahasiswaDetailController::class, 'update'])->name('mahasiswa.update');
        Route::get('print-id/{mahasiswa}', [PDFController::class, 'printId'])->name('print-id');
    });

    Route::resource('kalender', KalenderController::class);
    Route::post('getprovinsi', [MahasiswaController::class, 'getprovinsi'])->name('getprovinsi');
    Route::post('getkabupaten', [MahasiswaController::class, 'getkabupaten'])->name('getkabupaten');
    Route::post('getkecamatan', [MahasiswaController::class, 'getkecamatan'])->name('getkecamatan');
    
});