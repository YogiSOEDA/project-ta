<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('satuan.satuan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('satuan.create-satuan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Satuan::create([
            'satuan' => $request->satuan,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Satuan $satuan)
    {
        $data = Satuan::findOrFail($satuan->id);
        return view('satuan.update-satuan')->with([
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Satuan $satuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Satuan $satuan)
    {
        Satuan::where('id', $satuan->id)
            ->update([
                'satuan' => $request->satuan,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Satuan $satuan)
    {
        //
    }

    public function table()
    {
        $satuan = Satuan::query();
        return DataTables::of($satuan)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('template.btn-action')->with(['data' => $data]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function selectSatuan()
    {
        $data = Satuan::get();
        // dd($data);

        return view('template.select-satuan')->with([
            'data' => $data,
        ]);
    }
}
