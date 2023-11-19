<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index()
    {
        return view('laporan');
    }
    public function persediaan()
    {
        return view('persediaan-barang.persediaan-barang');
    }
    public function barangMasuk()
    {
        return view('barang-masuk');
    }
    public function barangKeluar()
    {
        return view('barang-keluar');
    }
}
