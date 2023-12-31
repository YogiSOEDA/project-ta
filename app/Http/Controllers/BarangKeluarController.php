<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\DetailBK;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('barang-keluar.barang-keluar');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang-keluar.create-barang-keluar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_barang = $request->id_barang;
        $qty = $request->qty;

        $id_bk = BarangKeluar::insertGetId([
            'proyek_id' => $request->proyek_id,
            'tanggal' => $request->input_tanggal,
            'user_id' => $request->user()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        foreach ($qty as $e => $qt) {
            if ($qt == 0) {
                continue;
            }

            $barang = Barang::where('id', $id_barang[$e])->first();

            $jumlah_brg = $barang->stok - $qty[$e];

            DetailBK::create([
                'bk_id' => $id_bk,
                'barang_id' => $id_barang[$e],
                'jumlah' => $qty[$e],
            ]);

            Barang::where('id', $id_barang[$e])
                ->update([
                    'stok' => $jumlah_brg,
                ]);
        }

        return redirect('/barang-keluar')->withSuccess('Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluar $barangKeluar)
    {
        $tgl = Carbon::createFromFormat('Y-m-d', $barangKeluar->tanggal)->format('d-m-Y');

        $detail = DetailBK::where('bk_id', $barangKeluar->id)->with('barang')->get();
        return view('barang-keluar.detail-barang-keluar')->with([
            'bk' => $barangKeluar,
            'detail' => $detail,
            'tgl' => $tgl
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        //
    }

    public function table()
    {
        $bk = BarangKeluar::query()->with('proyek');
        return DataTables::of($bk)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d-m-Y');
                // return $data->tanggal->format('d-m-Y');
                // return $data->tanggal->format('d-m-Y');
            })
            ->addColumn('action', function ($data) {
                return '<a href="barang-keluar/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
