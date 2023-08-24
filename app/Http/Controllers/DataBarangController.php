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
                return '<a href="#" data-id="'.$data->id.'" class="btn btn-warning tombol-edit"><i class="fas fa-pen"></i> Edit</a>';// /editbarang/'.$data->id. ' data-toggle="modal" data-target="#ModalTambahBarang"
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

    public function edit($id)
    {
        $data = Barang::where('id', $id)->first();
        return response()->json(['result' => $data]);
        // $barang = Barang::findorfail($id);
        // return compact('barang');
    }

    public function update(Request $request)
    {
        // ddd($request);
        // var_dump($request);
        // $data = [
        //     'nama_barang' => $request->nama_barang,
        //     'harga' => $request->harga,
        //     'gambar' => $request->file('gambar')->store('barang-images'),
        // ];

        // Barang::where('id', $id)->update([
        //     'nama_barang' => $request->nama_barang,
        //     'harga' => $request->harga,
        //     'gambar' => $request->file('gambar')->store('barang-images'),
        // ]);

        Barang::where('id', $request->id_barang)->update([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'gambar' => $request->file('gambar')->store('barang-images'),
        ]);
        return redirect('/databarang');
        // return response()->json(['success' => "Berhasil melakukan update data"]);
    }
}
