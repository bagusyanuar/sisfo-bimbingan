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
    Route::get( '/edit/{id}', [\App\Http\Controllers\Siswa\PengajuanController::class, 'edit_page']);
    Route::post( '/patch', [\App\Http\Controllers\Siswa\PengajuanController::class, 'patch']);
    Route::post( '/delete', [\App\Http\Controllers\Siswa\PengajuanController::class, 'destroy']);
});

Route::group(['prefix' => 'pengajuan-laporan'], function () {
    Route::get( '/', [\App\Http\Controllers\Admin\PengajuanController::class, 'index']);
    Route::get( '/detail/{id}', [\App\Http\Controllers\Admin\PengajuanController::class, 'detail']);
    Route::post( '/patch', [\App\Http\Controllers\Admin\PengajuanController::class, 'patch']);
});

Route::group(['prefix' => 'konsultasi'], function () {
    Route::get( '/{id}', [\App\Http\Controllers\Siswa\KonsultasiController::class, 'index']);
    Route::get( '/{id}/tambah', [\App\Http\Controllers\Siswa\KonsultasiController::class, 'add_page']);
    Route::post( '/{id}/create', [\App\Http\Controllers\Siswa\KonsultasiController::class, 'create']);
});

Route::group(['prefix' => 'konsultasi-guru'], function () {
    Route::get( '/', [\App\Http\Controllers\Guru\KonsultasiController::class, 'index']);
    Route::get( '/detail/{id}', [\App\Http\Controllers\Guru\KonsultasiController::class, 'detail']);
    Route::post( '/patch', [\App\Http\Controllers\Guru\KonsultasiController::class, 'patch']);
});

