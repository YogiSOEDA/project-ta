<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Http\Requests\StoreBarangMasukRequest;
use App\Http\Requests\UpdateBarangMasukRequest;
use App\Models\Barang;
use App\Models\DetailBM;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $awok = BarangMasuk::query();
        // dd($awok);
        return view('barang-masuk.barang-masuk');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang-masuk.create-barang-masuk');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_barang = $request->id_barang;
        $qty = $request->qty;

        $id_bm = BarangMasuk::insertGetId([
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

            $jumlah_brg = $barang->stok + $qty[$e];

            DetailBM::create([
                'bm_id' => $id_bm,
                'barang_id' => $id_barang[$e],
                'jumlah' => $qty[$e],
            ]);

            Barang::where('id', $id_barang[$e])
                ->update([
                    'stok' => $jumlah_brg,
                ]);
        }

        return redirect('/barang-masuk');
        // ddd($jumlah_brg);
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasuk $barangMasuk)
    {
        $detail = DetailBM::where('bm_id', $barangMasuk->id)->with('barang')->get();

        $tgl = Carbon::createFromFormat('Y-m-d', $barangMasuk->tanggal)->format('d-m-Y');

        // dd($tgl);
        return view('barang-masuk.detail-barang-masuk')->with([
            'bm' => $barangMasuk,
            'detail' => $detail,
            'tgl' => $tgl
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasuk $barangMasuk)
    {
        //
    }

    public function addRow(Request $request)
    {
        // ddd($request);
        $barang = Barang::findOrFail($request->barang_id);
        // return view('barang-masuk.create-row-table-barang-masuk');
        return view('barang-masuk.create-row-table-barang-masuk')->with([
            'barang' => $barang,
            'qty' => $request->qty,
            'number' => $request->number,
        ]);
        // return view('barang-masuk.create-row-table-barang-masuk')->with([
        //     'barang' => $barang,
        //     'qty' => $request->qty,
        //     'number' => $request->number,
        // ]);
    }

    public function tableBm()
    {
        $bm = BarangMasuk::query();
        return DataTables::of($bm)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '<a href="barang-masuk/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
