<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DenzibangController;
use App\Http\Controllers\SiwasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'login_proses'])->name('login-proses');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'register_proses'])->name('register-proses');

Route::group(['middleware' => ['auth', 'role:Siwas']], function () {
  Route::get('/dashboard', [SiwasController::class, 'dashboard'])->name('dashboard-siwas');
  Route::get('/data-pekerjaan', [SiwasController::class, 'data_pekerjaan'])->name('data-pekerjaan');
  Route::get('/data-pekerjaan/reguler', [SiwasController::class, 'reguler'])->name('pekerjaan-reguler');
  Route::get('/data-pekerjaan/swakelola', [SiwasController::class, 'swakelola'])->name('pekerjaan-swakelola');
  Route::get('/data-pekerjaan/sbsn', [SiwasController::class, 'sbsn'])->name('pekerjaan-sbsn');
  Route::get('/data-pekerjaan/hibah', [SiwasController::class, 'hibah'])->name('pekerjaan-hibah');
  Route::get('/data-pekerjaan/blu', [SiwasController::class, 'blu'])->name('pekerjaan-blu');
  Route::post('/data-pekerjaan/add', [SiwasController::class, 'add_pekerjaan'])->name('add-pekerjaan');
  Route::get('/data-pekerjaan/{id}', [SiwasController::class, 'find_pekerjaan'])->name('find-pekerjaan');
  Route::put('/data-pekerjaan/edit/{id}', [SiwasController::class, 'edit_pekerjaan'])->name('edit-pekerjaan');
  Route::delete('/data-pekerjaan/delete/{id}', [SiwasController::class, 'delete_pekerjaan'])->name('delete-pekerjaan');
  Route::get('/lapjusik', [SiwasController::class, 'lapjusik'])->name('lapjusik-siwas');
  Route::get('/cetak-data', [SiwasController::class, 'cetak_data'])->name('cetak-data');
  Route::get('/filter-data', [SiwasController::class, 'filter_data'])->name('filter-data');
  Route::get('/print-data', [SiwasController::class, 'print_data'])->name('print-data');
  Route::get('/download-gambar/{id}', [SiwasController::class, 'download_gambar'])->name('download-gambar');
  Route::get('/dokumentasi', [SiwasController::class, 'dokumentasi'])->name('dokumentasi');
  Route::get('/export-pdf', [SiwasController::class, 'export_pdf'])->name('export-pdf');
  Route::get('/about', [SiwasController::class, 'about'])->name('about');
});

Route::group(['middleware' => ['auth', 'role:Denzibang']], function () {
  Route::get('/dashboard-denz', [DenzibangController::class, 'dashboard'])->name('dashboard-denzibang');
  Route::get('/lapjusik-denz', [DenzibangController::class, 'lapjusik'])->name('lapjusik-denzibang');
  Route::get('/input-lapjusik', [DenzibangController::class, 'input_lapjusik'])->name('input-lapjusik');
  Route::get('/input-gambar', [DenzibangController::class, 'input_gambar'])->name('input-gambar');
  Route::get('/input-lapjusik/{id}', [DenzibangController::class, 'find_lapjusik'])->name('find-lapjusik');
  Route::put('/input-gambar/add/{id}', [DenzibangController::class, 'add_gambar'])->name('add-gambar');
  Route::put('/input-lapjusik/update/{id}', [DenzibangController::class, 'update_lapjusik'])->name('update-lapjusik');
});

Route::post('/logout', function () {
  Auth::logout();
  return redirect('/');  // Setelah logout, redirect ke halaman login
})->name('logout');
