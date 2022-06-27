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

