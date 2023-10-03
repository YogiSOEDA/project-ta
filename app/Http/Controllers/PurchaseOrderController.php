<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPO;
use App\Models\Proyek;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('purchase-order.purchase-order');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('purchase-order.detail-purchase-order');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_barang = $request->id_barang;
        $qty = $request->qty;
        $harga = $request->harga;

        $id_po = PurchaseOrder::insertGetId([
            'proyek_id' => $request->proyek_id,
            'tanggal' => $request->input_tanggal,
            'acc_direktur' => 'belum divalidasi',
            'acc_akunting' => 'belum divalidasi',
            'status' => 'belum diproses',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        foreach ($qty as $e => $qt) {
            if ($qt == 0) {
                continue;
            }

            DetailPO::create([
                'po_id' => $id_po,
                'barang_id' => $id_barang[$e],
                'jumlah' => $qty[$e],
                'harga' => $harga[$e],
            ]);
        }

        return redirect('/purchase-order');
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }

    public function viewProyek()
    {
        $data = Proyek::all();
        return view('template.select-proyek')->with([
            'data' => $data
        ]);
    }

    public function viewBarang()
    {
        $data = Barang::all();
        return view('template.select-barang')->with([
            'data' => $data
        ]);
    }

    public function addRow(Request $request)
    {
        $barang = Barang::findOrFail($request->barang_id);
        return view('purchase-order.create-row-table-po')->with([
            'barang' => $barang,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'number' => $request->number,
        ]);
    }

    public function table()
    {
        // $po = DB::table('purchase_order')
        // ->join('proyek', 'purchase_order.proyek_id','=','proyek.id')
        // ->select('purchase_order.*', 'proyek.nama_proyek')
        // ->get();
        $po = PurchaseOrder::query()->with('proyek');
        return DataTables::of($po)
            ->addIndexColumn()
            // ->addColumn('proyek', function ($data) {
            //     return $data->proyek->nama_proyek;
            // })
            ->addColumn('stat_dir', function ($data) {
                if ($data->acc_direktur == 'belum divalidasi') {
                    return '<div class="btn bg-danger">' . $data->acc_direktur . '</div>';
                } elseif ($data->acc_direktur == 'divalidasi') {
                    return '<div class="btn bg-success">' . $data->acc_direktur . '</div>';
                }
            })
            ->addColumn('stat_akt', function ($data) {
                if ($data->acc_akunting == 'belum divalidasi') {
                    return '<div class="btn bg-danger">' . $data->acc_akunting . '</div>';
                } elseif ($data->acc_akunting == 'divalidasi') {
                    return '<div class="btn bg-success">' . $data->acc_akunting . '</div>';
                }
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 'belum diproses') {
                    return '<div class="btn bg-danger">' . $data->status . '</div>';
                } elseif ($data->status == 'selesai') {
                    return '<div class="btn bg-success">' . $data->status . '</div>';
                } elseif ($data->status == 'diproses') {
                    return '<div class="btn bg-info">' . $data->status . '</div>';
                } elseif ($data->status == 'perlu perbaikan') {
                    return '<div class="btn bg-warning">' . $data->status . '</div>';
                }
            })
            ->addColumn('action', function ($data) {
                if ($data->acc_direktur == 'divalidasi' || $data->acc_akunting == 'divalidasi') {
                    return '<button class="btn btn-info" onclick="show(' . $data->id . ')"><i class="fa-solid fa-circle-info"></i> Detail</button>';
                } else {
                    return '<button class="btn btn-info" onclick="show(' . $data->id . ')"><i class="fa-solid fa-circle-info"></i> Detail</button> <button class="btn btn-warning" onclick="edit(' . $data->id . ')"><i class="fas fa-pen"></i> Edit</button>';
                }
            })
            ->rawColumns(['stat_dir', 'stat_akt', 'status', 'action'])
            ->make(true);
    }
}
