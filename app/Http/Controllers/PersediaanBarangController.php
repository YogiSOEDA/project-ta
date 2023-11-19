<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PersediaanBarangController extends Controller
{
    //
    public function index()
    {
        return view('persediaan-barang.persediaan-barang');
    }

    public function table()
    {
        $barang = Barang::query();
        return DataTables::of($barang)
            ->addIndexColumn()
            ->make(true);
    }
}
