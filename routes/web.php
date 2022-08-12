<?php

use Illuminate\Support\Facades\Route;

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
Route::match(['post', 'get'], '/', [\App\Http\Controllers\AuthController::class, 'login']);
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);

Route::group(['prefix' => 'admin'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\AdminController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\AdminController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\AdminController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\AdminController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\AdminController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\AdminController::class, 'destroy']);
});

Route::group(['prefix' => 'guru'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\GuruController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\GuruController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\GuruController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\GuruController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\GuruController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\GuruController::class, 'destroy']);
});

Route::group(['prefix' => 'siswa'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\SiswaController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\SiswaController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\SiswaController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\SiswaController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\SiswaController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\SiswaController::class, 'destroy']);
});

Route::group(['prefix' => 'jurusan'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\JurusanController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\JurusanController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\JurusanController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\JurusanController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\JurusanController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\JurusanController::class, 'destroy']);
});

Route::group(['prefix' => 'kelas'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\KelasController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Admin\KelasController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Admin\KelasController::class, 'create']);
    Route::get( '/edit/{id}', [\App\Http\Controllers\Admin\KelasController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\KelasController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Admin\KelasController::class, 'destroy']);
});


Route::group(['prefix' => 'pengajuan'], function () {
    Route::get( '/', [\App\Http\Controllers\Siswa\PengajuanController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Siswa\PengajuanController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Siswa\PengajuanController::class, 'create']);
});

Route::group(['prefix' => 'berkas'], function () {
    Route::get( '/', [\App\Http\Controllers\Siswa\BerkasController::class, 'index']);
    Route::get( '/tambah', [\App\Http\Controllers\Siswa\BerkasController::class, 'add_page']);
    Route::post( '/create', [\App\Http\Controllers\Siswa\BerkasController::class, 'create']);
});

Route::group(['prefix' => 'pengajuan-laporan'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\PengajuanController::class, 'index']);
    Route::get( '/detail/{id}', [\App\Http\Controllers\Admin\PengajuanController::class, 'detail']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\PengajuanController::class, 'patch']);
});

Route::group(['prefix' => 'pengajuan-berkas'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\BerkasController::class, 'index']);
    Route::get( '/detail/{id}', [\App\Http\Controllers\Admin\BerkasController::class, 'detail']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\BerkasController::class, 'patch']);
});

Route::group(['prefix' => 'konsultasi'], function () {
    Route::get( '/', [\App\Http\Controllers\Siswa\KonsultasiController::class, 'index']);
    Route::get( '/{id}/tambah', [\App\Http\Controllers\Siswa\KonsultasiController::class, 'add_page']);
    Route::post( '/{id}/create', [\App\Http\Controllers\Siswa\KonsultasiController::class, 'create']);
    Route::get( '/{id}/cetak', [\App\Http\Controllers\Siswa\KonsultasiController::class, 'cetak']);
});

Route::group(['prefix' => 'konsultasi-guru'], function () {
    Route::get( '/', [\App\Http\Controllers\Guru\KonsultasiController::class, 'index']);
    Route::get( '/detail/{id}', [\App\Http\Controllers\Guru\KonsultasiController::class, 'detail']);
    Route::post( '/patch', [\App\Http\Controllers\Guru\KonsultasiController::class, 'patch']);
});

Route::group(['prefix' => 'siswa-bimbingan'], function () {
    Route::get( '/', [\App\Http\Controllers\Guru\SiswaController::class, 'index']);
    Route::get( '/detail/{id}', [\App\Http\Controllers\Guru\SiswaController::class, 'detail']);
    Route::post( '/patch', [\App\Http\Controllers\Guru\SiswaController::class, 'patch']);
    Route::post( '/finish', [\App\Http\Controllers\Guru\SiswaController::class, 'finish']);
});

Route::group(['prefix' => 'laporan-pengajuan'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\LaporanController::class, 'index']);
    Route::get( '/data', [\App\Http\Controllers\Admin\LaporanController::class, 'data_pengajuan']);
    Route::get( '/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'cetak']);
});

Route::group(['prefix' => 'laporan-bimbingan-proses'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\LaporanController::class, 'proses']);
    Route::get( '/data', [\App\Http\Controllers\Admin\LaporanController::class, 'data_proses']);
    Route::get( '/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'cetak_proses']);
});

Route::group(['prefix' => 'laporan-bimbingan-selesai'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\LaporanController::class, 'selesai']);
    Route::get( '/data', [\App\Http\Controllers\Admin\LaporanController::class, 'data_selesai']);
    Route::get( '/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'cetak_selesai']);
});

Route::group(['prefix' => 'laporan-konsultasi'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\LaporanController::class, 'konsultasi']);
    Route::get( '/data', [\App\Http\Controllers\Admin\LaporanController::class, 'data_konsultasi']);
    Route::get( '/cetak', [\App\Http\Controllers\Admin\LaporanController::class, 'cetak_konsultasi']);
});



