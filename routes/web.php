<?php

use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataProyekController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\PurchaseOrderController;
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

    Route::get('/dataproyek', [DataProyekController::class, 'index'])->name('dataproyek');
    Route::get('/dataproyek/create', [DataProyekController::class, 'create']);
    Route::get('/dataproyek/store', [DataProyekController::class, 'store']);
    Route::get('/dataproyek/tabelproyek', [DataProyekController::class, 'table']);
    Route::get('/dataproyek/show/{id}', [DataProyekController::class, 'show']);
    Route::get('/dataproyek/update/{id}', [DataProyekController::class, 'update']);

    Route::get('/databarang', [DataBarangController::class, 'index'])->name('databarang');
    Route::get('/tabelbarang', [DataBarangController::class, 'table'])->name('tabelbarang');
    Route::post('/storedatabarang', [DataBarangController::class, 'store'])->name('storedatabarang');
    Route::get('/editbarang/{id}', [DataBarangController::class, 'edit']);
    Route::post('/updatebarang', [DataBarangController::class, 'update'])->name('updatebarang');

    Route::get('/purchase-order', [PurchaseOrderController::class, 'index'])->name('purchaseOrder');
    Route::get('/purchase-order/create', [PurchaseOrderController::class, 'create'])->name('createPO');
    Route::post('/purchase-order/store', [PurchaseOrderController::class, 'store'])->name('storePO');
    Route::get('/purchase-order/tabelpo', [PurchaseOrderController::class, 'table']);

    Route::get('/select-proyek', [PurchaseOrderController::class, 'viewProyek']);
    Route::get('/select-barang', [PurchaseOrderController::class, 'viewBarang']);
    Route::get('/add-row',[PurchaseOrderController::class, 'addRow']);

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/persediaan', [GudangController::class, 'persediaan'])->name('persediaan');
    Route::get('/barang-masuk', [GudangController::class, 'barangMasuk'])->name('barang-masuk');
    Route::get('/barang-keluar', [GudangController::class, 'barangKeluar'])->name('barang-keluar');
    Route::get('/request-material', [PurchaseController::class, 'requestMaterial'])->name('requestMaterial');
    // Route::get('/purchase-order', [PurchaseController::class, 'purchase'])->name('purchaseOrder');
    Route::get('/prediksi', [PrediksiController::class, 'index'])->name('prediksi');
});

// Route::middleware(['auth', 'rolecheck::admin'])->group(function () {
//     Route::get('/dashboard', [UserController::class, 'index']);
// });

