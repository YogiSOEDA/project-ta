<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Proyek;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.laporan');
    }

    public function table()
    {
        $proyek = Proyek::query();
        return DataTables::of($proyek)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '<a href="/laporan/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show(Proyek $proyek)
    {
        return view('laporan.detail-laporan')->with([
            'proyek' => $proyek
        ]);
    }

    public function tableHistory(Proyek $proyek)
    {
        $barang = BarangKeluar::join('detail_barang_keluar', 'barang_keluar.id', '=', 'detail_barang_keluar.bk_id')
            ->where('barang_keluar.proyek_id', '=', $proyek->id)
            ->join('barang', 'detail_barang_keluar.barang_id', '=', 'barang.id')
            ->join('satuan', 'barang.satuan_id', '=', 'satuan.id')
            ->select('barang_keluar.tanggal', 'detail_barang_keluar.jumlah', 'barang.nama_barang', 'satuan.satuan')
            ->get();

        return DataTables::of($barang)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d-m-Y');
            })
            ->editColumn('jumlah', function ($data) {
                return $data->jumlah . ' ' . $data->satuan;
            })
            ->make(true);
    }

    public function tableHistoryFilter(Request $request)
    {
        $barang = BarangKeluar::join('detail_barang_keluar', 'barang_keluar.id', '=', 'detail_barang_keluar.bk_id')
            ->where('barang_keluar.proyek_id', '=', $request->proyek_id)
            ->join('barang', 'detail_barang_keluar.barang_id', '=', 'barang.id')
            ->whereBetween('barang_keluar.tanggal', [$request->tgl_awal, $request->tgl_akhir])
            ->select('barang_keluar.tanggal', 'detail_barang_keluar.jumlah', 'barang.nama_barang')
            ->orderBy('barang_keluar.tanggal', 'desc')
            ->get();

        return DataTables::of($barang)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d-m-Y');
            })
            ->editColumn('jumlah', function ($data) {
                return $data->jumlah . ' ' . $data->satuan;
            })
            ->make(true);
        // return view('dashboard');
        // return response()->json(['result' => $barang]);
        // return response()->json(['awal' => 'Hallo Bro']);
    }

    public function awok()
    {
        return 'awok awok';
        // return view('dashboard');
    }
}
