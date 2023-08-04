<?php

use App\Models\Bidang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BidangController;
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
Route::put('suratmasuk/{id}/tindakan', [SuratMasukController::class, 'updateTindakan'])->name('suratmasuk.updateTindakan');

Route::get('dataoperator/{id}/password', [DataOperatorController::class, 'editPassword'])->name('dataoperator.password');
Route::get('dataoperator/{id}/role', [DataOperatorController::class, 'editRole'])->name('dataoperator.role');
Route::patch('dataoperator/{id}/password', [DataOperatorController::class, 'updatePassword'])->name('dataoperator.updatePassword');
Route::patch('dataoperator/{id}/role', [DataOperatorController::class, 'updateRole'])->name('dataoperator.updateRole');

Route::resource('dataoperator', DataOperatorController::class);
Route::resource('bidang', BidangController::class);


// Route::get('/suratmasuk/tambah', [App\Http\Controllers\TambahSuratMasukController::class, 'index'])->name('tambah');
Route::get('/suratkeluar', [App\Http\Controllers\SuratKeluarController::class, 'index'])->name('suratkeluar');
Route::get('/disposisi', [App\Http\Controllers\DisposisiController::class, 'index'])->name('disposisi');