<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPO;
use App\Models\Proyek;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $proyek = Proyek::all();
        // $testing = [
        //     'ehe' => 'awok awok',
        //     'aje' => 1,
        // ];
        // dd($testing);
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

        foreach ($qty as $e=>$qt) {
            if($qt == 0) {
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

}
