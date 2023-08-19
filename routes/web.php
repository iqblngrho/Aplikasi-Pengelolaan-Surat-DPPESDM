<?php

use App\Models\Bidang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\DataOperatorController;
use App\Http\Controllers\TambahSuratMasukController;
use App\Models\Disposisi;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('auth.login');
});

Auth::routes();

Route::middleware(['role:admin|sekretaris|Kepala Dinas|Kepala Bidang Industri'])->group(function () {
    Route::put('suratmasuk/{id}/tindakan', [SuratMasukController::class, 'updateTindakan'])->name('suratmasuk.updateTindakan');
});

Route::middleware(['role:admin|sekretaris|Kepala Dinas'])->group(function () {
    Route::get('suratmasuk/{id}', [SuratMasukController::class, 'show'])->name('suratmasuk.show');
});

Route::middleware(['role:admin'])->group(function () {
    Route::resource('suratmasuk', SuratMasukController::class);
});

Route::get('bidang/all', [BidangController::class, 'all']);

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::get('dataoperator/{id}/password', [DataOperatorController::class, 'editPassword'])->name('dataoperator.password');
Route::get('dataoperator/{id}/role', [DataOperatorController::class, 'editRole'])->name('dataoperator.role');
Route::patch('dataoperator/{id}/password', [DataOperatorController::class, 'updatePassword'])->name('dataoperator.updatePassword');
Route::patch('dataoperator/{id}/role', [DataOperatorController::class, 'updateRole'])->name('dataoperator.updateRole');

Route::resource('dashboard', DashboardController::class);
Route::resource('dataoperator', DataOperatorController::class);
Route::resource('bidang', BidangController::class);
Route::resource('disposisi', DisposisiController::class);

// Route::get('/suratmasuk/tambah', [App\Http\Controllers\TambahSuratMasukController::class, 'index'])->name('tambah');
Route::get('/suratkeluar', [App\Http\Controllers\SuratKeluarController::class, 'index'])->name('suratkeluar');
