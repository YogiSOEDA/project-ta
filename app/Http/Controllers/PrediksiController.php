<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\Prediksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PrediksiController extends Controller
{
    public function index()
    {
        // $years = BarangKeluar::selectRaw('extract(year FROM tanggal) AS year')
        //     ->distinct()
        //     ->orderBy('year', 'desc')
        //     ->get();

        // dd($years);

        // $dateS = Carbon::now()->startOfMonth();
        // $dateS->month = 10;
        // $dateS->year = 2022;
        // $dateE = Carbon::now();
        // $dateE->month = 10;
        // $dateE->year = 2022;
        // $dateE->endOfMonth();

        // $date1m = Carbon::now();
        // $date1m->month = 10;
        // $date1m->year = 2022;
        // $date1m->startOfMonth()->subMonth();


        // $date = $dateS->endOfMonth();
        // $date1m = $date->subMonth(2);

        // $bk = BarangKeluar::join('detail_barang_keluar', 'barang_keluar.id', '=', 'detail_barang_keluar.bk_id')
        //     ->whereBetween('tanggal', [$dateS, $dateE])
        //     ->where('detail_barang_keluar.barang_id', '=', 1)
        //     ->select('detail_barang_keluar.jumlah')
        //     ->sum('detail_barang_keluar.jumlah');


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
        // ddd($request->barang);

        $dateAwal = Carbon::now()->startOfMonth();
        $dateAwal->month = $request->bulan_ramal;
        $dateAwal->year = $request->tahun_ramal;

        $dateAkhir = Carbon::now()->startOfMonth();
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

        $dateAkhir1BulanLalu = Carbon::now()->startOfMonth();
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

        $dateAkhir2BulanLalu = Carbon::now()->startOfMonth();
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

        $dateAkhir3BulanLalu = Carbon::now()->startOfMonth();
        $dateAkhir3BulanLalu->month = $request->bulan_ramal;
        $dateAkhir3BulanLalu->year = $request->tahun_ramal;
        $dateAkhir3BulanLalu->subMonth(3);
        $dateAkhir3BulanLalu->endOfMonth();

        // dd($dateAkhir3BulanLalu);

        $total_pemakaian_3_bulan_lalu =
            BarangKeluar::join('detail_barang_keluar', 'barang_keluar.id', '=', 'detail_barang_keluar.bk_id')
            ->whereBetween('tanggal', [$dateAwal3BulanLalu, $dateAkhir3BulanLalu])
            ->where('detail_barang_keluar.barang_id', '=', $request->barang)
            ->select('detail_barang_keluar.jumlah')
            ->sum('detail_barang_keluar.jumlah');

        $wma = (($total_pemakaian_1_bulan_lalu * 3) + ($total_pemakaian_2_bulan_lalu * 2) + ($total_pemakaian_3_bulan_lalu * 1)) / 6;

        $error = $total_pemakaian_aktual - $wma;

        $mad = abs($error);

        $mse = $mad * $mad;

        $mape = $mad / $total_pemakaian_aktual * 100;

        if ($request->bulan_ramal == 1) {
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

        $prediksi_hasil = Prediksi::insertGetId([
            'barang_id' => $request->barang,
            'bulan' => $request->bulan_ramal,
            'tahun' => $request->tahun_ramal,
            'total_pengeluaran' => $total_pemakaian_aktual,
            'wma' => $wma,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // dd($mape);
        // return view('prediksi.hasil-prediksi')->with([
        //     'satu_bulan_lalu' => $total_pemakaian_1_bulan_lalu,
        //     'dua_bulan_lalu' => $total_pemakaian_2_bulan_lalu,
        //     'tiga_bulan_lalu' => $total_pemakaian_3_bulan_lalu,
        //     'nilai_aktual' => $total_pemakaian_aktual,
        //     'wma' => $wma,
        //     'error' => $error,
        //     'mad' => $mad,
        //     'mse' => $mse,
        //     'mape' => $mape,
        //     'tahun' => $request->tahun_ramal,
        //     'bulan' => $bulan
        // ]);

        $barang = Barang::findOrFail($request->barang);
        // $barang = Barang::findOrFail($request->barang)->with('satuan');
        // ddd($barang);

        return view('prediksi.modal-body-hasil-prediksi')->with([
            'wma' => $wma,
            'tahun' => $request->tahun_ramal,
            'bulan' => $bulan,
            'barang' => $barang,
            'prediksi_hasil' => $prediksi_hasil,
        ]);
    }

    public function table()
    {
        $barang = Barang::select('id', 'nama_barang')->get();
        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '<a href="/prediksi/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show(Barang $barang)
    {
        // dd($barang);
        return view('prediksi.history-prediksi')->with([
            'id_barang' => $barang->id,
            'nama_barang' => $barang->nama_barang
        ]);
    }

    public function tableHistory(Barang $barang)
    {
        // dd($barang);
        $history = Prediksi::where('barang_id', $barang->id)->get();
        return DataTables::of($history)
            ->addIndexColumn()
            ->addColumn('bulan_tahun', function ($data) {
                if ($data->bulan == 1) {
                    return
                        'JANUARI ' . $data->tahun;
                } elseif ($data->bulan == 2) {
                    return
                        "FEBRUARI " . $data->tahun;
                } elseif ($data->bulan == 3) {
                    return
                        "MARET " . $data->tahun;
                } elseif ($data->bulan == 4) {
                    return
                        "APRIL " . $data->tahun;
                } elseif ($data->bulan == 5) {
                    return
                        "MEI " . $data->tahun;
                } elseif ($data->bulan == 6) {
                    return
                        "JUNI " . $data->tahun;
                } elseif ($data->bulan == 7) {
                    return
                        "JULI " . $data->tahun;
                } elseif ($data->bulan == 8) {
                    return
                        "AGUSTUS " . $data->tahun;
                } elseif ($data->bulan == 9) {
                    return
                        "SEPTEMBER " . $data->tahun;
                } elseif ($data->bulan == 10) {
                    return
                        "OKTOBER " . $data->tahun;
                } elseif ($data->bulan == 11) {
                    return
                        "NOVEMBER " . $data->tahun;
                } elseif ($data->bulan == 12) {
                    return
                        "DESEMBER " . $data->tahun;
                }
            })
            ->addColumn('total_error', function ($data) {
                return $data->total_pengeluaran - $data->wma;
            })
            ->addColumn('total_mad', function ($data) {
                $mad = $data->total_pengeluaran - $data->wma;
                return abs($mad);
            })
            ->addColumn('total_mse', function ($data) {
                $mad = $data->total_pengeluaran - $data->wma;
                return $mad*$mad;
            })
            ->addColumn('total_mape', function ($data) {
                $error = $data->total_pengeluaran - $data->wma;
                $mad = abs($error);
                return $mad/ $data->total_pengeluaran*100;
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at->format('d-m-Y');
            })
            ->addColumn('action', function ($data) {
            return '<a href="/prediksi/detail/'.$data->id.'" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function showDetailPerhitungan(Prediksi $prediksi)
    {
        if ($prediksi->bulan == 1) {
            $bulan = "JANUARI";
        } elseif ($prediksi->bulan == 2) {
            $bulan = "FEBRUARI";
        } elseif ($prediksi->bulan == 3) {
            $bulan = "MARET";
        } elseif ($prediksi->bulan == 4) {
            $bulan = "APRIL";
        } elseif ($prediksi->bulan == 5) {
            $bulan = "MEI";
        } elseif ($prediksi->bulan == 6) {
            $bulan = "JUNI";
        } elseif ($prediksi->bulan == 7) {
            $bulan = "JULI";
        } elseif ($prediksi->bulan == 8) {
            $bulan = "AGUSTUS";
        } elseif ($prediksi->bulan == 9) {
            $bulan = "SEPTEMBER";
        } elseif ($prediksi->bulan == 10) {
            $bulan = "OKTOBER";
        } elseif ($prediksi->bulan == 11) {
            $bulan = "NOVEMBER";
        } elseif ($prediksi->bulan == 12) {
            $bulan = "DESEMBER";
        }

        $dateAwal1BulanLalu = Carbon::now()->startOfMonth();
        $dateAwal1BulanLalu->month = $prediksi->bulan;
        $dateAwal1BulanLalu->year = $prediksi->tahun;
        $dateAwal1BulanLalu->subMonth();

        $dateAkhir1BulanLalu = Carbon::now()->startOfMonth();
        $dateAkhir1BulanLalu->month = $prediksi->bulan;
        $dateAkhir1BulanLalu->year = $prediksi->tahun;
        $dateAkhir1BulanLalu->subMonth();
        $dateAkhir1BulanLalu->endOfMonth();

        $total_pemakaian_1_bulan_lalu =
            BarangKeluar::join('detail_barang_keluar', 'barang_keluar.id', '=', 'detail_barang_keluar.bk_id')
            ->whereBetween('tanggal', [$dateAwal1BulanLalu, $dateAkhir1BulanLalu])
            ->where('detail_barang_keluar.barang_id', '=', $prediksi->barang_id)
            ->select('detail_barang_keluar.jumlah')
            ->sum('detail_barang_keluar.jumlah');

        $dateAwal2BulanLalu = Carbon::now()->startOfMonth();
        $dateAwal2BulanLalu->month = $prediksi->bulan;
        $dateAwal2BulanLalu->year = $prediksi->tahun;
        $dateAwal2BulanLalu->subMonth(2);

        $dateAkhir2BulanLalu = Carbon::now()->startOfMonth();
        $dateAkhir2BulanLalu->month = $prediksi->bulan;
        $dateAkhir2BulanLalu->year = $prediksi->tahun;
        $dateAkhir2BulanLalu->subMonth(2);
        $dateAkhir2BulanLalu->endOfMonth();

        $total_pemakaian_2_bulan_lalu =
            BarangKeluar::join('detail_barang_keluar', 'barang_keluar.id', '=', 'detail_barang_keluar.bk_id')
            ->whereBetween('tanggal', [$dateAwal2BulanLalu, $dateAkhir2BulanLalu])
            ->where('detail_barang_keluar.barang_id', '=', $prediksi->barang_id)
            ->select('detail_barang_keluar.jumlah')
            ->sum('detail_barang_keluar.jumlah');

        $dateAwal3BulanLalu = Carbon::now()->startOfMonth();
        $dateAwal3BulanLalu->month = $prediksi->bulan;
        $dateAwal3BulanLalu->year = $prediksi->tahun;
        $dateAwal3BulanLalu->subMonth(3);

        $dateAkhir3BulanLalu = Carbon::now()->startOfMonth();
        $dateAkhir3BulanLalu->month = $prediksi->bulan;
        $dateAkhir3BulanLalu->year = $prediksi->tahun;
        $dateAkhir3BulanLalu->subMonth(3);
        $dateAkhir3BulanLalu->endOfMonth();

        $total_pemakaian_3_bulan_lalu =
            BarangKeluar::join('detail_barang_keluar', 'barang_keluar.id', '=', 'detail_barang_keluar.bk_id')
            ->whereBetween('tanggal', [$dateAwal3BulanLalu, $dateAkhir3BulanLalu])
            ->where('detail_barang_keluar.barang_id', '=', $prediksi->barang_id)
            ->select('detail_barang_keluar.jumlah')
            ->sum('detail_barang_keluar.jumlah');

        $error = $prediksi->total_pengeluaran - $prediksi->wma;

        $mad = abs($error);

        $mse = $mad * $mad;

        $mape = $mad / $prediksi->total_pengeluaran * 100;

        $barang = Barang::findOrFail($prediksi->barang_id);

        return view('prediksi.detail-prediksi')->with([
            'bulan' => $bulan,
            'tahun' => $prediksi->tahun,
            'wma' => $prediksi->wma,
            'satu_bulan_lalu' => $total_pemakaian_1_bulan_lalu,
            'dua_bulan_lalu' => $total_pemakaian_2_bulan_lalu,
            'tiga_bulan_lalu' => $total_pemakaian_3_bulan_lalu,
            'nilai_aktual' => $prediksi->total_pengeluaran,
            'error' => $error,
            'mad' => $mad,
            'mse' => $mse,
            'mape' => $mape,
            'barang' => $barang,
        ]);
    }
}
