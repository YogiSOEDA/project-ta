<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailRM;
use App\Models\RequestMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RequestMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Auth::id());
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

    public function table()
    {
        $rm = RequestMaterial::where('user_id', Auth::id())->with('proyek')->with('user');
        return DataTables::of($rm)
            ->addIndexColumn()
            ->editColumn('jenis_request', function ($data) {
                return '<span style= "text-transform:capitalize">' . $data->jenis_request . '</span>';
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 'belum diproses') {
                    return '<div class="btn bg-danger">' . $data->status . '</div>';
                } elseif ($data->status == 'diproses') {
                    return '<div class="btn bg-warning">' . $data->status . '</div>';
                } elseif ($data->status == 'selesai') {
                    return '<div class="btn bg-success">' . $data->status . '</div>';
                }
            })
            ->addColumn('action', function ($data) {
                if ($data->status == 'belum diproses') {
                    return '<a href="/teknisi/request-material/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a> <a href="/teknisi/request-material/' . $data->id . '/edit" class="btn btn-warning"><i class="fas fa-pen"></i> Edit</a>';
                } else {
                    return '<a href="/teknisi/request-material/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>';
                }
            })
            ->rawColumns(['jenis_request','status', 'action'])
            ->make(true);
    }
}
