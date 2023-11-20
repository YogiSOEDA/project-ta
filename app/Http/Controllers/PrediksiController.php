<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PrediksiController extends Controller
{
    public function index()
    {
        // $years = BarangKeluar::selectRaw('extract(year FROM tanggal) AS year')
        //     ->distinct()
        //     ->orderBy('year', 'desc')
        //     ->get();

        // dd($years);

        $dateS = Carbon::now()->startOfMonth();
        $dateS->month = 10;
        $dateS->year = 2022;
        $dateE = Carbon::now();
        $dateE->month = 10;
        $dateE->year = 2022;
        $dateE->endOfMonth();

        $date1m = Carbon::now();
        $date1m->month = 10;
        $date1m->year = 2022;
        $date1m->startOfMonth()->subMonth();
        // $date = $dateS->endOfMonth();
        // $date1m = $date->subMonth(2);

        $bk = BarangKeluar::join('detail_barang_keluar', 'barang_keluar.id', '=', 'detail_barang_keluar.bk_id')
            ->whereBetween('tanggal', [$dateS, $dateE])
            ->where('detail_barang_keluar.barang_id', '=', 1)
            ->select('detail_barang_keluar.jumlah')
            ->sum('detail_barang_keluar.jumlah');


        // $bk = BarangKeluar::whereBetween('tanggal',[$dateS,$dateE])->get();

        // dd($bk);
        return view('prediksi.prediksi');
    }

    public function viewYears()
    {
        $data = BarangKeluar::selectRaw('extract(year FROM tanggal) AS year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->get();

        return view('template.select-years')->with([
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $dateAwal = Carbon::now()->startOfMonth();
        $dateAwal->month = $request->bulan_ramal;
        $dateAwal->year = $request->tahun_ramal;

        $dateAkhir = Carbon::now();
        $dateAkhir->month = $request->bulan_ramal;
        $dateAkhir->year = $request->tahun_ramal;
        $dateAkhir->endOfMonth();

        $total_pemakaian_aktual =
            BarangKeluar::join('detail_barang_keluar', 'barang_keluar.id', '=', 'detail_barang_keluar.bk_id')
            ->whereBetween('tanggal', [$dateAwal, $dateAkhir])
            ->where('detail_barang_keluar.barang_id', '=', $request->barang)
            ->select('detail_barang_keluar.jumlah')
            ->sum('detail_barang_keluar.jumlah');

        $dateAwal1BulanLalu = Carbon::now()->startOfMonth();
        $dateAwal1BulanLalu->month = $request->bulan_ramal;
        $dateAwal1BulanLalu->year = $request->tahun_ramal;
        $dateAwal1BulanLalu->subMonth();

        $dateAkhir1BulanLalu = Carbon::now();
        $dateAkhir1BulanLalu->month = $request->bulan_ramal;
        $dateAkhir1BulanLalu->year = $request->tahun_ramal;
        $dateAkhir1BulanLalu->subMonth();
        $dateAkhir1BulanLalu->endOfMonth();

        $total_pemakaian_1_bulan_lalu =
            BarangKeluar::join('detail_barang_keluar', 'barang_keluar.id', '=', 'detail_barang_keluar.bk_id')
            ->whereBetween('tanggal', [$dateAwal1BulanLalu, $dateAkhir1BulanLalu])
            ->where('detail_barang_keluar.barang_id', '=', $request->barang)
            ->select('detail_barang_keluar.jumlah')
            ->sum('detail_barang_keluar.jumlah');

        $dateAwal2BulanLalu = Carbon::now()->startOfMonth();
        $dateAwal2BulanLalu->month = $request->bulan_ramal;
        $dateAwal2BulanLalu->year = $request->tahun_ramal;
        $dateAwal2BulanLalu->subMonth(2);

        $dateAkhir2BulanLalu = Carbon::now();
        $dateAkhir2BulanLalu->month = $request->bulan_ramal;
        $dateAkhir2BulanLalu->year = $request->tahun_ramal;
        $dateAkhir2BulanLalu->subMonth(2);
        $dateAkhir2BulanLalu->endOfMonth();

        $total_pemakaian_2_bulan_lalu =
            BarangKeluar::join('detail_barang_keluar', 'barang_keluar.id', '=', 'detail_barang_keluar.bk_id')
            ->whereBetween('tanggal', [$dateAwal2BulanLalu, $dateAkhir2BulanLalu])
            ->where('detail_barang_keluar.barang_id', '=', $request->barang)
            ->select('detail_barang_keluar.jumlah')
            ->sum('detail_barang_keluar.jumlah');

        $dateAwal3BulanLalu = Carbon::now()->startOfMonth();
        $dateAwal3BulanLalu->month = $request->bulan_ramal;
        $dateAwal3BulanLalu->year = $request->tahun_ramal;
        $dateAwal3BulanLalu->subMonth(3);

        $dateAkhir3BulanLalu = Carbon::now();
        $dateAkhir3BulanLalu->month = $request->bulan_ramal;
        $dateAkhir3BulanLalu->year = $request->tahun_ramal;
        $dateAkhir3BulanLalu->subMonth(3);
        $dateAkhir3BulanLalu->endOfMonth();

        $total_pemakaian_3_bulan_lalu =
            BarangKeluar::join('detail_barang_keluar', 'barang_keluar.id', '=', 'detail_barang_keluar.bk_id')
            ->whereBetween('tanggal', [$dateAwal3BulanLalu, $dateAkhir3BulanLalu])
            ->where('detail_barang_keluar.barang_id', '=', $request->barang)
            ->select('detail_barang_keluar.jumlah')
            ->sum('detail_barang_keluar.jumlah');

        $wma = (($total_pemakaian_1_bulan_lalu*3)+($total_pemakaian_2_bulan_lalu*2)+($total_pemakaian_3_bulan_lalu*1))/6;

        $error = $total_pemakaian_aktual-$wma;

        $mad = abs($error);

        $mse = $mad*$mad;

        $mape = $mad/$total_pemakaian_aktual*100;

        if($request->bulan_ramal == 1) {
            $bulan = "JANUARI";
        } elseif ($request->bulan_ramal == 2) {
            $bulan = "FEBRUARI";
        } elseif ($request->bulan_ramal == 3) {
            $bulan = "MARET";
        } elseif ($request->bulan_ramal == 4) {
            $bulan = "APRIL";
        } elseif ($request->bulan_ramal == 5) {
            $bulan = "MEI";
        } elseif ($request->bulan_ramal == 6) {
            $bulan = "JUNI";
        } elseif ($request->bulan_ramal == 7) {
            $bulan = "JULI";
        } elseif ($request->bulan_ramal == 8) {
            $bulan = "AGUSTUS";
        } elseif ($request->bulan_ramal == 9) {
            $bulan = "SEPTEMBER";
        } elseif ($request->bulan_ramal == 10) {
            $bulan = "OKTOBER";
        } elseif ($request->bulan_ramal == 11) {
            $bulan = "NOVEMBER";
        } elseif ($request->bulan_ramal == 12) {
            $bulan = "DESEMBER";
        }


        // dd($mape);
        return view('prediksi.hasil-prediksi')->with([
            'satu_bulan_lalu' => $total_pemakaian_1_bulan_lalu,
            'dua_bulan_lalu' => $total_pemakaian_2_bulan_lalu,
            'tiga_bulan_lalu' => $total_pemakaian_3_bulan_lalu,
            'nilai_aktual' => $total_pemakaian_aktual,
            'wma' => $wma,
            'error' => $error,
            'mad' => $mad,
            'mse' => $mse,
            'mape' => $mape,
            'tahun' => $request->tahun_ramal,
            'bulan' => $bulan
        ]);
    }
}
