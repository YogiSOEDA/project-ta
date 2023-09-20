<?php

namespace App\Http\Controllers;

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
        return view('purchase-order.purchase-order');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Proyek::all();
        return view('purchase-order.create-po')->with([
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $stringDate = strtotime($request->tanggal);
        // $convertDate= date('')


        PurchaseOrder::create([
            'proyek_id' => $request->proyek_id,
            'tanggal' => $request->tanggal,
            'acc_direktur' => 'belum divalidasi',
            'acc_akunting' => 'belum divalidasi',
            'status' => 'belum diproses',
        ]);
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
}
