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
        // $data['barang'] = DB::table('barang')->orderBy('nama_barang')->get();
        // $data['barang'] =  Barang::query()->get();
        return view('barang');
        // $barang = Barang::paginate(10);

        // return view('barang', ['barang' => $barang]);
    }

    public function table()
    {
        // $barang = DB::table('barang')->orderBy('nama_barang');

        $barang = Barang::query();
        return DataTables::of($barang)
            ->addIndexColumn()
            ->editColumn('gambar', function($data) {
                // dd($data)
                // $awok = `<img src="` + $data->gambar + `" class="img-fluid mb-2"/>`;
                return '<img src='.$data->gambar. ' class="img-fluid mb-2" style="max-width:30%"/>';
            })
            ->addColumn('action', function ($data) {
                return '<a href="#" class="btn btn-warning"><i class="fa-light fa-pen">Edit</i></a>';
            })
            ->rawColumns(['gambar','action'])
            ->make(true);
    }
}
