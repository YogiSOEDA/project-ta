<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPO;
use App\Models\DetailRM;
use App\Models\PurchaseOrder;
use App\Models\RequestMaterial;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Undefined;
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

        return redirect('/teknisi/request-material')->withSuccess('Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(RequestMaterial $requestMaterial)
    {
        // dd($requestMaterial);
        $tgl_req = Carbon::createFromFormat('Y-m-d', $requestMaterial->tanggal_request)->format('d-m-Y');
        $tgl_keb = Carbon::createFromFormat('Y-m-d', $requestMaterial->tanggal_kebutuhan)->format('d-m-Y');
        $detail = DetailRM::where('rm_id', $requestMaterial->id)->where('jumlah', '>', 0)->with('barang')->get();
        return view('request-material.teknisi.detail-request-material')->with([
            'rm' => $requestMaterial,
            'detail' => $detail,
            'tgl_req' => $tgl_req,
            'tgl_keb' => $tgl_keb,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestMaterial $requestMaterial)
    {
        $tgl_req = Carbon::createFromFormat('Y-m-d', $requestMaterial->tanggal_request)->format('d-m-Y');
        $tgl_keb = Carbon::createFromFormat('Y-m-d', $requestMaterial->tanggal_kebutuhan)->format('d-m-Y');
        $detail = DetailRM::where('rm_id', $requestMaterial->id)->where('jumlah', '>', 0)->with('barang')->get();
        return view('request-material.teknisi.edit-request-material')->with([
            'rm' => $requestMaterial,
            'detail' => $detail,
            'tgl_req' => $tgl_req,
            'tgl_keb' => $tgl_keb,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestMaterial $requestMaterial)
    {
        $id_detail_rm = $request->id_detail_rm;
        $qty = $request->qty;
        $id_barang = $request->id_barang;

        foreach ($qty as $e => $qt) {
            if ($id_detail_rm[$e] != 0) {
                DetailRM::where('id', $id_detail_rm[$e])
                    ->update([
                        'jumlah' => $qty[$e],
                    ]);
            } elseif ($id_detail_rm[$e] == 0) {
                if ($qt == 0) {
                    continue;
                }

                DetailRM::create([
                    'rm_id' => $requestMaterial->id,
                    'barang_id' => $id_barang[$e],
                    'jumlah' => $qty[$e],
                ]);
            }
            // return $id_detail_rm[$e];
            // dd($id_barang[$e]);
        }

        return redirect('/teknisi/request-material')->withSuccess('Data Berhasil Disimpan');
        // ddd($request);
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
        $rm = RequestMaterial::where('user_id', Auth::id())->with('proyek');
        return DataTables::of($rm)
            ->addIndexColumn()
            ->editColumn('jenis_request', function ($data) {
                return '<span style= "text-transform:capitalize">' . $data->jenis_request . '</span>';
            })
            ->editColumn('tanggal_request', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal_request)->format('d-m-Y');
            })
            ->editColumn('tanggal_kebutuhan', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal_kebutuhan)->format('d-m-Y');
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
            ->rawColumns(['jenis_request', 'status', 'action'])
            ->make(true);
    }

    public function deleteItem($id)
    {
        DetailRM::where('id', $id)->update([
            'jumlah' => 0,
        ]);
        // dd($requestMaterial->id);
        // $detailRM->id;
        // return response()->json(['result' => $detailRM]);
    }

    public function viewRMAdmin()
    {
        return view('request-material.request-material');
    }

    public function tableRMAdmin()
    {
        $rm = RequestMaterial::where('status', 'belum diproses')->with('proyek');
        return DataTables::of($rm)
            ->addIndexColumn()
            ->editColumn('jenis_request', function ($data) {
                return '<span style= "text-transform:capitalize">' . $data->jenis_request . '</span>';
            })
            ->editColumn('tanggal_request', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal_request)->format('d-m-Y');
            })
            ->editColumn('tanggal_kebutuhan', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal_kebutuhan)->format('d-m-Y');
            })
            ->editColumn('status', function ($data) {
                if ($data->status == 'belum diproses') {
                    return '<div class="btn bg-danger">' . $data->status . '</div>';
                } elseif ($data->status == 'diproses') {
                    return '<div class="btn bg-warning">' . $data->status . '</div>';
                } elseif ($data->status == 'selesai') {
                    return '<div class="btn bg-success">' . $data->status . '</div>';
                }
            })
            ->addColumn('action', function ($data) {
                return '<a href="/request-material/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a> <a href="/request-material/' . $data->id . '/proses" class="btn btn-success"><i class="fa-regular fa-square-check"></i> Proses</a>';
            })
            ->rawColumns(['status', 'action', 'jenis_request'])
            ->make(true);
    }

    public function tableRMAdminDone()
    {
        $rm = RequestMaterial::where('status', '!=', 'belum diproses')->with('proyek');
        return DataTables::of($rm)
            ->addIndexColumn()
            ->editColumn('jenis_request', function ($data) {
                return '<span style= "text-transform:capitalize">' . $data->jenis_request . '</span>';
            })
            ->editColumn('tanggal_request', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal_request)->format('d-m-Y');
            })
            ->editColumn('tanggal_kebutuhan', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal_kebutuhan)->format('d-m-Y');
            })
            ->editColumn('status', function ($data) {
                if ($data->status == 'belum diproses') {
                    return '<div class="btn bg-danger">' . $data->status . '</div>';
                } elseif ($data->status == 'diproses') {
                    return '<div class="btn bg-warning">' . $data->status . '</div>';
                } elseif ($data->status == 'selesai') {
                    return '<div class="btn bg-success">' . $data->status . '</div>';
                }
            })
            ->addColumn('action', function ($data) {
                return '<a href="/request-material/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>';
            })
            ->rawColumns(['status', 'action', 'jenis_request'])
            ->make(true);
    }

    public function showRM(RequestMaterial $requestMaterial)
    {
        $tgl_req = Carbon::createFromFormat('Y-m-d', $requestMaterial->tanggal_request)->format('d-m-Y');
        $tgl_kbt = Carbon::createFromFormat('Y-m-d', $requestMaterial->tanggal_kebutuhan)->format('d-m-Y');
        $detail = DetailRM::where('rm_id', $requestMaterial->id)->where('jumlah', '>', 0)->with('barang')->get();
        return view('request-material.detail-request-material')->with([
            'rm' => $requestMaterial,
            'detail' => $detail,
            'tgl_req' => $tgl_req,
            'tgl_kbt' => $tgl_kbt
        ]);
    }

    public function prosesRM(RequestMaterial $requestMaterial)
    {
        $tgl_req = Carbon::createFromFormat('Y-m-d', $requestMaterial->tanggal_request)->format('d-m-Y');
        $tgl_kbt = Carbon::createFromFormat('Y-m-d', $requestMaterial->tanggal_kebutuhan)->format('d-m-Y');
        $detail = DetailRM::where('rm_id', $requestMaterial->id)->where('jumlah', '>', 0)->with('barang')->get();
        return view('request-material.proses-request-material')->with([
                'rm' => $requestMaterial,
                'detail' => $detail,
                'tgl_req' => $tgl_req,
                'tgl_kbt' => $tgl_kbt
            ]
        );
    }

    public function storePO(Request $request, RequestMaterial $requestMaterial)
    {
        // ddd($requestMaterial);
        $id_barang = $request->id_barang;
        $qty = $request->qty;
        $harga = $request->harga;

        // foreach ($qty as $e => $qt) {
        //     $awok = str_replace(",","",$harga) ;
        // }

        // dd($awok);

        $id_po = PurchaseOrder::insertGetId([
            'proyek_id' => $request->proyek_id,
            'jenis_request' => $request->jenis_request,
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
                'harga' => str_replace(",", "",$harga[$e]),
            ]);
        }

        RequestMaterial::where('id', $request->id_rm)->update([
            'status' => 'diproses',
        ]);

        return redirect('/request-material')->withSuccess('Data Berhasil Disimpan');
    }

    public function viewRMLogistik()
    {
        return view('request-material.logistik.request-material');
    }

    public function tableRMLogistik()
    {
        $rm = RequestMaterial::where('status', 'diproses')->with('proyek');
        return DataTables::of($rm)
            ->addIndexColumn()
            ->editColumn('jenis_request', function ($data) {
                return '<span style= "text-transform:capitalize">' . $data->jenis_request . '</span>';
            })
            ->editColumn('tanggal_request', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal_request)->format('d-m-Y');
            })
            ->editColumn('tanggal_kebutuhan', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal_kebutuhan)->format('d-m-Y');
            })
            ->editColumn('status', function ($data) {
                if ($data->status == 'belum diproses') {
                    return '<div class="btn bg-danger">' . $data->status . '</div>';
                } elseif ($data->status == 'diproses') {
                    return '<div class="btn bg-warning">' . $data->status . '</div>';
                } elseif ($data->status == 'selesai') {
                    return '<div class="btn bg-success">' . $data->status . '</div>';
                }
            })
            ->addColumn('action', function ($data) {
                return '<a href="/logistik/request-material/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>';
            })
            ->rawColumns(['status', 'action', 'jenis_request'])
            ->make(true);
    }

    public function viewDetailRMLogistik(RequestMaterial $requestMaterial)
    {
        $tgl_req = Carbon::createFromFormat('Y-m-d', $requestMaterial->tanggal_request)->format('d-m-Y');
        $tgl_kbt = Carbon::createFromFormat('Y-m-d', $requestMaterial->tanggal_kebutuhan)->format('d-m-Y');
        $detail = DetailRM::where('rm_id', $requestMaterial->id)->where('jumlah', '>', 0)->with('barang')->get();
        return view('request-material.logistik.detail-request-material')->with([
            'rm' => $requestMaterial,
            'detail' => $detail,
            'tgl_req' => $tgl_req,
            'tgl_kbt' => $tgl_kbt
        ]);
    }
}
