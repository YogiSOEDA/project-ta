<?php

use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataProyekController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

// Route::get('/login', function () {
//     return view('login');
// })->name('login');

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
});

// Route::middleware(['auth', 'rolecheck::admin'])->group(function () {
//     Route::get('/dashboard', [UserController::class, 'index']);
// });

Route::post('/storedatabarang', [DataBarangController::class, 'store'])->name('storedatabarang');
