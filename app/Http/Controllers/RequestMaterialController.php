<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailRM;
use App\Models\RequestMaterial;
use Illuminate\Http\Request;

class RequestMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('request-material.teknisi.request-material');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('request-material.teknisi.create-request-material');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $user = $request->user()->id;
        // dd($user);

        $id_barang = $request->id_barang;
        $qty = $request->qty;

        $id_rm = RequestMaterial::insertGetId([
            'user_id' => $request->user()->id,
            'jenis_request' => $request->jenis_request,
            'tanggal_request' => $request->input_tanggal_request,
            'tanggal_kebutuhan' => $request->input_tanggal_kebutuhan,
            'proyek_id' => $request->proyek_id,
            'status' => 'belum diproses',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        foreach ($qty as $e => $qt) {
            if ($qt == 0) {
                continue;
            }

            DetailRM::create([
                'rm_id' => $id_rm,
                'barang_id' => $id_barang[$e],
                'jumlah' => $qty[$e],
            ]);
        }

        return redirect('/teknisi/request-material');
    }

    /**
     * Display the specified resource.
     */
    public function show(RequestMaterial $requestMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestMaterial $requestMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestMaterial $requestMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequestMaterial $requestMaterial)
    {
        //
    }

    public function addRow(Request $request)
    {
        $barang = Barang::findOrFail($request->barang_id);
        return view('request-material.teknisi.create-row-rm')->with([
            'barang' => $barang,
            'qty' => $request->qty,
            'number' => $request->number,
        ]);
    }
}
