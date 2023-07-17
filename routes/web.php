<?php

use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataProyekController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/postlogin', [UserController::class, 'postlogin'])->name('postlogin');
Route::post('/saveregister', [UserController::class, 'register'])->name('saveregister');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/dashboard', [UserController::class, 'index']);
// });

Route::group(['middleware' => ['auth', 'rolecheck:admin']], function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::get('/databarang', [DataBarangController::class, 'index'])->name('databarang');
    Route::get('/tabelbarang', [DataBarangController::class, 'table'])->name('tabelbarang');
    Route::get('/dataproyek', [DataProyekController::class, 'index'])->name('dataproyek');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
});

// Route::middleware(['auth', 'rolecheck::admin'])->group(function () {
//     Route::get('/dashboard', [UserController::class, 'index']);
// });

Route::post('/storedatabarang', [DataBarangController::class, 'store'])->name('storedatabarang');
