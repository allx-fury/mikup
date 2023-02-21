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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect()->route('home');
    });    
    Route::get('dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');
    Route::resource('server', App\Http\Controllers\ServerController::class);
    Route::resource('upload', App\Http\Controllers\TransaksiUploadController::class);
    Route::resource('instansi', App\Http\Controllers\InstansiController::class);
    Route::post('exec', [App\Http\Controllers\ServerController::class, 'exec'])->name('exec');
    Route::get('files', [App\Http\Controllers\TransaksiUploadController::class, 'files'])->name('files');
    Route::post('files/upload', [App\Http\Controllers\TransaksiUploadController::class, 'proses_upload'])->name('pilih');
});
