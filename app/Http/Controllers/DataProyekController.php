<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Proyek;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DataProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('proyek.proyek');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proyek.create-proyek');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Proyek::create([
            'nama_proyek' => $request->nama_proyek,
            'cp_proyek' => $request->cp_proyek,
        ]);
    }

    public function table()
    {
        $proyek = Proyek::query();
        return DataTables::of($proyek)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return view('template.btn-action')->with(['data' => $data]); //'<button class="btn btn-warning" onclick="show('.$data->id.')"><i class="fas fa-pen"></i> Edit</button>';  //'<a href="#" class="btn btn-warning"><i class="fas fa-pen"></i> Edit</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Proyek::findOrFail($id);
        return view('proyek.update-proyek')->with([
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Proyek::where('id', $request->id)
            ->update([
                'nama_proyek' => $request->nama_proyek,
                'cp_proyek' => $request->cp_proyek,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
