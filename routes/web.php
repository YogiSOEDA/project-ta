<?php

use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataProyekController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\RequestMaterialController;
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
    // Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::get('/dataproyek', [DataProyekController::class, 'index'])->name('dataproyek');
    Route::get('/dataproyek/create', [DataProyekController::class, 'create']);
    Route::get('/dataproyek/store', [DataProyekController::class, 'store']);
    Route::get('/dataproyek/tabelproyek', [DataProyekController::class, 'table']);
    Route::get('/dataproyek/show/{id}', [DataProyekController::class, 'show']);
    Route::get('/dataproyek/update/{id}', [DataProyekController::class, 'update']);

    Route::get('/data-barang', [DataBarangController::class, 'index'])->name('databarang');
    Route::get('/data-barang/create', [DataBarangController::class, 'create']);
    Route::get('/tabelbarang', [DataBarangController::class, 'table'])->name('tabelbarang');
    Route::post('/data-barang/store', [DataBarangController::class, 'store'])->name('storeBarang');
    Route::get('/data-barang/show/{id}', [DataBarangController::class, 'show']);
    Route::get('/data-barang/edit/{id}', [DataBarangController::class, 'edit']);
    Route::post('/data-barang/update', [DataBarangController::class, 'update'])->name('updatebarang');
    Route::get('/data-barang/add-row-type', [DataBarangController::class, 'addRowType']);
    Route::get('/data-barang/add-row-ukuran', [DataBarangController::class, 'addRowUkuran']);

    Route::get('/purchase-order', [PurchaseOrderController::class, 'index'])->name('purchaseOrder');
    Route::get('/purchase-order/create', [PurchaseOrderController::class, 'create'])->name('createPO');
    Route::post('/purchase-order/store', [PurchaseOrderController::class, 'store'])->name('storePO');
    Route::get('/purchase-order/tabelpo', [PurchaseOrderController::class, 'table']);
    Route::get('/purchase-order/show/{id}', [PurchaseOrderController::class, 'show']);
    Route::resource('/purchase-order', PurchaseOrderController::class);
    Route::post('/purchase-order/update', [PurchaseOrderController::class, 'update'])->name('updatePO');
    // Route::get('/purchase-order/detail-table/{id}', [PurchaseOrderController::class, 'tableDetail']);

    // Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barangMasuk');
    // Route::resource('/barang-masuk', BarangMasukController::class);

    // Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barangKeluar');
    // Route::resource('/barang-keluar', BarangKeluarController::class);

    // Route::get('/select-proyek', [PurchaseOrderController::class, 'viewProyek']);
    // Route::get('/select-barang', [PurchaseOrderController::class, 'viewBarang']);
    Route::get('/add-row', [PurchaseOrderController::class, 'addRow']);

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    // Route::get('/persediaan', [GudangController::class, 'persediaan'])->name('persediaan');
    Route::get('/request-material', [PurchaseController::class, 'requestMaterial'])->name('requestMaterial');
    // Route::get('/purchase-order', [PurchaseController::class, 'purchase'])->name('purchaseOrder');
    Route::get('/prediksi', [PrediksiController::class, 'index'])->name('prediksi');

    Route::get('/barang-masuk/tabelbm', [BarangMasukController::class, 'tableBm']);
    Route::get('/barang-keluar/tabelbk', [BarangKeluarController::class, 'table']);
});

Route::group(['middleware' => ['auth', 'rolecheck:admin,logistik,akunting,direktur,teknisi']], function() {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
});

Route::group(['middleware' => ['auth', 'rolecheck:admin,logistik']], function () {
    Route::get('/persediaan', [GudangController::class, 'persediaan'])->name('persediaan');

    Route::resource('/barang-masuk', BarangMasukController::class);
    Route::get('/barang-masuk/tabelbm', [BarangMasukController::class, 'tableBm']);
    // Route::get('/barang-masuk/tabelbm', [BarangMasukController::class, 'tableBm']);
    Route::get('/add-row-bm', [BarangMasukController::class, 'addRow']);

    Route::resource('/barang-keluar', BarangKeluarController::class);
    Route::get('/barang-keluar/tabelbk', [BarangKeluarController::class, 'table']);

    Route::get('/select-proyek', [PurchaseOrderController::class, 'viewProyek']);
    Route::get('/select-barang', [PurchaseOrderController::class, 'viewBarang']);
});

Route::group(['middleware' => ['auth', 'rolecheck:logistik']], function () {
    Route::get('/logistik/purchase-order', [PurchaseOrderController::class, 'viewPoLogistik']);
});

Route::group(['middleware' => ['auth', 'rolecheck:akunting']], function () {
    Route::get('/akunting/purchase-order', [PurchaseOrderController::class, 'viewPoAkunting']);
    Route::get('/akunting/purchase-order/tabelpo', [PurchaseOrderController::class, 'tablePoAkt']);
    Route::get('/akunting/purchase-order/tabelpoacc', [PurchaseOrderController::class, 'tablePoAktAcc']);
    Route::get('/akunting/purchase-order/{purchase_order}', [PurchaseOrderController::class, 'showPoAkt']);
    Route::get('/akunting/purchase-order/{purchase_order}/acc', [PurchaseOrderController::class, 'accPoAkt']);
});

Route::group(['middleware' => ['auth', 'rolecheck:admin,akunting']], function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
});

Route::group(['middleware' => ['auth', 'rolecheck:direktur']], function () {
    Route::get('/direktur/purchase-order', [PurchaseOrderController::class, 'viewPoDirektur']);
    Route::get('/direktur/purchase-order/tabelpo', [PurchaseOrderController::class, 'tablePoDir']);
    Route::get('/direktur/purchase-order/tabelpoacc', [PurchaseOrderController::class, 'tablePoDirAcc']);
    Route::get('/direktur/purchase-order/{purchase_order}', [PurchaseOrderController::class, 'showPoDir']);
    Route::get('/direktur/purchase-order/{purchase_order}/acc', [PurchaseOrderController::class, 'accPoDir']);
});

Route::group(['middleware' => ['auth', 'rolecheck:teknisi']], function () {
    Route::get('/teknisi/request-material', [RequestMaterialController::class, 'index']);
    Route::get('/teknisi/request-material/create', [RequestMaterialController::class, 'create'])->name('createRM');
    Route::get('/teknisi/request-material/select-proyek', [PurchaseOrderController::class, 'viewProyek']);
    Route::get('/teknisi/request-material/select-barang', [PurchaseOrderController::class, 'viewBarang']);
    Route::get('/teknisi/request-material/add-row', [RequestMaterialController::class, 'addRow']);
    Route::post('/teknisi/request-material/store', [RequestMaterialController::class, 'store'])->name('storeRM');
    Route::get('/teknisi/request-material/tabel', [RequestMaterialController::class, 'table']);
    Route::get('/teknisi/request-material/{request_material}', [RequestMaterialController::class, 'show']);
    Route::get('/teknisi/request-material/{request_material}/edit', [RequestMaterialController::class, 'edit']);
    Route::get('/teknisi/request-material/{id}/delete-row', [RequestMaterialController::class, 'deleteItem']);
    Route::post('/teknisi/request-material/{request_material}/update', [RequestMaterialController::class, 'update']);
});

// Route::middleware(['auth', 'rolecheck::admin'])->group(function () {
//     Route::get('/dashboard', [UserController::class, 'index']);
// });
