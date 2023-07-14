<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DataBarangController extends Controller
{
    //
    public function index()
    {
        return view('barang');
    }

    public function table()
    {
        $barang = Barang::query();
        return DataTables::of($barang)
            ->addIndexColumn()
            ->editColumn('gambar', function($data) {
                $awok = 'storage/'.$data->gambar;
                return '<img src="/storage/'.$data->gambar.'" class="img-fluid mb-2" style="max-width:30%"/>';
            })
            ->addColumn('action', function ($data) {
                return '<a href="#" class="btn btn-warning"><i class="fas fa-pen"></i> Edit</a>';
            })
            ->rawColumns(['gambar','action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'gambar' => $request->file('gambar')->store('barang-images'),
        ]);

        return redirect('/databarang');
    }
}
