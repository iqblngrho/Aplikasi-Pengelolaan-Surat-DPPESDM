<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\DataOperatorController;
use App\Http\Controllers\TambahSuratMasukController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('suratmasuk', SuratMasukController::class);
Route::resource('dataoperator', DataOperatorController::class);
// Route::get('/suratmasuk/tambah', [App\Http\Controllers\TambahSuratMasukController::class, 'index'])->name('tambah');
Route::get('/suratkeluar', [App\Http\Controllers\SuratKeluarController::class, 'index'])->name('home');
Route::get('/disposisi', [App\Http\Controllers\DisposisiController::class, 'index'])->name('home');
