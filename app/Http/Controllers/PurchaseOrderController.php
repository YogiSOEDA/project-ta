<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailPO;
use App\Models\Komentar;
use App\Models\Proyek;
use App\Models\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('purchase-order.create-purchase-order');
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
            'jenis_request' => $request->jenis_request,
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
        $tgl = Carbon::createFromFormat('Y-m-d', $purchaseOrder->tanggal)->format('d-m-Y');
        $detail = DetailPO::where('po_id', $purchaseOrder->id)
            ->with('barang')
            ->get();
        return view('purchase-order.detail-purchase-order')->with([
            'po' => $purchaseOrder,
            'detail' => $detail,
            'tgl' => $tgl,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        $detail = DetailPO::where('po_id', $purchaseOrder->id)
            ->with('barang')
            ->get();
        return view('purchase-order.edit-purchase-order')->with([
            'po' => $purchaseOrder,
            'detail' => $detail,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $id_detail_po = $request->id_detail_po;
        $qty = $request->qty;
        $harga = $request->harga;

        PurchaseOrder::where('id', $purchaseOrder->id)->update([
            'status' => 'belum diproses',
        ]);

        foreach ($qty as $e => $qt) {
            DetailPO::where('id', $id_detail_po[$e])->update([
                'jumlah' => $qty[$e],
                'harga' => str_replace(",", "",$harga[$e]),
            ]);
        }

        return redirect('/purchase-order');
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
            'data' => $data,
        ]);
    }

    public function viewBarang()
    {
        $data = Barang::all();
        return view('template.select-barang')->with([
            'data' => $data,
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
        $po = PurchaseOrder::query()->with('proyek');
        return DataTables::of($po)
            ->addIndexColumn()
            ->editColumn('jenis_request', function ($data) {
                return '<span style= "text-transform:capitalize">' . $data->jenis_request . '</span>';
            })
            ->editColumn('tanggal', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d-m-Y');
            })
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
                if ($data->status == 'perlu perbaikan') {
                    return '<a href="purchase-order/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a> <a href="purchase-order/' . $data->id . '/edit" class="btn btn-warning"><i class="fas fa-pen"></i> Edit</a>';
                } elseif ($data->acc_direktur == 'divalidasi' || $data->acc_akunting == 'divalidasi') {
                    return '<a href="purchase-order/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>';
                } else {
                    return '<a href="purchase-order/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a> <a href="purchase-order/' . $data->id . '/edit" class="btn btn-warning"><i class="fas fa-pen"></i> Edit</a>';
                }
            })
            ->rawColumns(['stat_dir', 'stat_akt', 'status', 'action', 'jenis_request'])
            ->make(true);
    }

    public function viewPoAkunting()
    {
        $title = 'Tolak Purchase Order!';
        $text = 'Anda yakin menolak purchase order ini?';
        confirmDelete($title, $text);
        return view('purchase-order.akunting.purchase-order');
    }

    public function viewPoDirektur()
    {
        return view('purchase-order.direktur.purchase-order');
    }

    public function tablePoDir()
    {
        $po = PurchaseOrder::where('acc_direktur', 'belum divalidasi')->with('proyek');
        return DataTables::of($po)
            ->addIndexColumn()
            ->editColumn('jenis_request', function ($data) {
                return '<span style= "text-transform:capitalize">' . $data->jenis_request . '</span>';
            })
            ->editColumn('tanggal', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d-m-Y');
            })
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
            ->addColumn('action', function ($data) {
                if ($data->status == 'perlu perbaikan') {
                    $komen = Komentar::where('po_id', $data->id)->where('user_id', Auth::user()->id)->where('komentar', '!=', 'Acc')->count();

                    if ($komen >= 1) {
                        return '<a href="/direktur/purchase-order/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>';
                    }
                }
                // if ($data->acc_direktur == 'divalidasi' || $data->acc_akunting == 'divalidasi') {
                //     return '<a href="purchase-order/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>';
                // } else {
                return '<a href="/direktur/purchase-order/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a> <a href="/direktur/purchase-order/' . $data->id . '/acc" class="btn btn-success"><i class="fa-solid fa-check"></i> Accept</a> <button class="btn btn-danger" onclick="decline(' . $data->id . ')"><i class="fa-solid fa-x"></i> Decline</button>'; //<a href="/direktur/purchase-order/' . $data->id . '/decline" class="btn btn-danger"><i class="fa-solid fa-x"></i> Decline</a>';
                // }
            })
            ->rawColumns(['stat_dir', 'stat_akt', 'status', 'action', 'jenis_request'])
            ->make(true);
    }

    public function tablePoDirAcc()
    {
        $po = PurchaseOrder::where('acc_direktur', 'divalidasi')->with('proyek');
        return DataTables::of($po)
            ->addIndexColumn()
            ->editColumn('jenis_request', function ($data) {
                return '<span style= "text-transform:capitalize">' . $data->jenis_request . '</span>';
            })
            ->editColumn('tanggal', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d-m-Y');
            })
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
            ->addColumn('action', function ($data) {
                // if ($data->acc_direktur == 'divalidasi' || $data->acc_akunting == 'divalidasi') {
                return '<a href="/direktur/purchase-order/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>';
                // } else {
                //     return '<a href="purchase-order/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a> <a href="purchase-order/' . $data->id . '/edit" class="btn btn-warning"><i class="fas fa-pen"></i> Edit</a>';
                // }
            })
            ->rawColumns(['stat_dir', 'stat_akt', 'status', 'action', 'jenis_request'])
            ->make(true);
    }

    public function showPoDir(PurchaseOrder $purchaseOrder)
    {
        // $po = PurchaseOrder::where('id', $id)->with('proyek')->get();
        $detail = DetailPO::where('po_id', $purchaseOrder->id)
            ->with('barang')
            ->get();

        $komen = Komentar::where('po_id', $purchaseOrder->id)
            ->where('user_id', Auth::user()->id)
            ->where('komentar', '!=', 'Acc')
            ->count();

        $tgl = Carbon::createFromFormat('Y-m-d', $purchaseOrder->tanggal)->format('d-m-Y');

        return view('purchase-order.direktur.detail-purchase-order')->with([
            'po' => $purchaseOrder,
            'detail' => $detail,
            'komen' => $komen,
            'tgl' => $tgl,
        ]);
    }

    public function accPoDir(PurchaseOrder $purchaseOrder)
    {
        $user = Auth::user()->id;
        // dd($user);

        PurchaseOrder::where('id', $purchaseOrder->id)->update([
            'acc_direktur' => 'divalidasi',
        ]);

        Komentar::create([
            'po_id' => $purchaseOrder->id,
            'user_id' => $user,
            'komentar' => 'Acc',
        ]);

        return redirect('/direktur/purchase-order')->withSuccess('Data Berhasil Disimpan');
    }

    public function viewPoLogistik()
    {
        return view('purchase-order.logistik.purchase-order');
    }

    public function tablePoAkt()
    {
        $po = PurchaseOrder::where('acc_akunting', 'belum divalidasi')->with('proyek');
        return DataTables::of($po)
            ->addIndexColumn()
            ->editColumn('jenis_request', function ($data) {
                return '<span style= "text-transform:capitalize">' . $data->jenis_request . '</span>';
            })
            ->editColumn('tanggal', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d-m-Y');
            })
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
            ->addColumn('action', function ($data) {
                // if ($data->acc_direktur == 'divalidasi' || $data->acc_akunting == 'divalidasi') {
                //     return '<a href="purchase-order/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>';
                // } else {

                if ($data->status == 'perlu perbaikan') {
                    $komen = Komentar::where('po_id', $data->id)->where('user_id', Auth::user()->id)->where('komentar', '!=', 'Acc')->count();

                    if ($komen >= 1) {
                        return '<a href="/direktur/purchase-order/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>';
                    }
                }

                return '<a href="/akunting/purchase-order/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a> <a href="/akunting/purchase-order/' . $data->id . '/acc" class="btn btn-success"><i class="fa-solid fa-check"></i> Accept</a> <button class="btn btn-danger" onclick="decline(' . $data->id . ')"><i class="fa-solid fa-x"></i> Decline</button>';
                // }
            })
            ->rawColumns(['stat_dir', 'stat_akt', 'status', 'action', 'jenis_request'])
            ->make(true);
    }

    public function tablePoAktAcc()
    {
        $po = PurchaseOrder::where('acc_akunting', 'divalidasi')->with('proyek');
        return DataTables::of($po)
            ->addIndexColumn()
            ->editColumn('jenis_request', function ($data) {
                return '<span style= "text-transform:capitalize">' . $data->jenis_request . '</span>';
            })
            ->editColumn('tanggal', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d-m-Y');
            })
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
            ->addColumn('action', function ($data) {
                // if ($data->acc_direktur == 'divalidasi' || $data->acc_akunting == 'divalidasi') {
                return '<a href="/akunting/purchase-order/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>';
                // } else {
                //     return '<a href="purchase-order/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a> <a href="purchase-order/' . $data->id . '/edit" class="btn btn-warning"><i class="fas fa-pen"></i> Edit</a>';
                // }
            })
            ->rawColumns(['stat_dir', 'stat_akt', 'status', 'action', 'jenis_request'])
            ->make(true);
    }

    public function showPoAkt(PurchaseOrder $purchaseOrder)
    {
        // $po = PurchaseOrder::where('id', $id)->with('proyek')->get();
        $detail = DetailPO::where('po_id', $purchaseOrder->id)
            ->with('barang')
            ->get();

        $komen = Komentar::where('po_id', $purchaseOrder->id)
            ->where('user_id', Auth::user()->id)
            ->where('komentar', '!=', 'Acc')
            ->count();

        $tgl = Carbon::createFromFormat('Y-m-d', $purchaseOrder->tanggal)->format('d-m-Y');

        return view('purchase-order.akunting.detail-purchase-order')->with([
            'po' => $purchaseOrder,
            'detail' => $detail,
            'komen' => $komen,
            'tgl' => $tgl,
        ]);
    }

    public function accPoAkt(PurchaseOrder $purchaseOrder)
    {
        $user = Auth::user()->id;

        PurchaseOrder::where('id', $purchaseOrder->id)->update([
            'acc_akunting' => 'divalidasi',
        ]);

        // dd($user);
        Komentar::create([
            'po_id' => $purchaseOrder->id,
            'user_id' => $user,
            'komentar' => 'Acc',
        ]);

        return redirect('/akunting/purchase-order')->withSuccess('Data Berhasil Disimpan');
    }

    public function tablePoLogistik()
    {
        $po = PurchaseOrder::where('acc_direktur', 'divalidasi')
            ->where('acc_akunting', 'divalidasi')
            ->with('proyek');
        return DataTables::of($po)
            ->addIndexColumn()
            ->editColumn('jenis_request', function ($data) {
                return '<span style= "text-transform:capitalize">' . $data->jenis_request . '</span>';
            })
            ->editColumn('tanggal', function ($data) {
                return Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d-m-Y');
            })
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
                // if ($data->acc_direktur == 'divalidasi' || $data->acc_akunting == 'divalidasi') {
                return '<a href="/logistik/purchase-order/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>';
                // } else {
                //     return '<a href="purchase-order/' . $data->id . '" class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a> <a href="purchase-order/' . $data->id . '/edit" class="btn btn-warning"><i class="fas fa-pen"></i> Edit</a>';
                // }
            })
            ->rawColumns(['stat_dir', 'stat_akt', 'status', 'action', 'jenis_request'])
            ->make(true);
    }

    public function viewDetailPOLogistik(PurchaseOrder $purchaseOrder)
    {
        $detail = DetailPO::where('po_id', $purchaseOrder->id)
            ->with('barang')
            ->get();

            $tgl = Carbon::createFromFormat('Y-m-d', $purchaseOrder->tanggal)->format('d-m-Y');
        return view('purchase-order.logistik.detail-purchase-order')->with([
            'po' => $purchaseOrder,
            'detail' => $detail,
            'tgl' => $tgl,
        ]);
    }

    public function insertKomentar(Request $request)
    {
        // ddd($request);
        // $user => 'user_id';
        // $request['user_id'] = Auth::user()->id;
        // return $request;

        Komentar::create([
            'po_id' => $request->id_po,
            'user_id' => $request->user()->id,
            'komentar' => $request->keterangan,
        ]);

        PurchaseOrder::where('id', $request->id_po)
            ->update([
                'status' => 'perlu perbaikan',
            ]);

        if ($request->user()->role == 'direktur') {
            return redirect('/direktur/purchase-order')->withSuccess('Data Berhasil Disimpan');
        } elseif ($request->user()->role == 'akunting') {
            return redirect('/akunting/purchase-order')->withSuccess('Data Berhasil Disimpan');
        }
    }

    public function tableKeterangan(PurchaseOrder $purchaseOrder)
    {
        $ket = Komentar::where('po_id', $purchaseOrder->id)->get();
        return DataTables::of($ket)
            ->addIndexColumn()
            ->addColumn('user', function ($data) {
                return ucfirst($data->user->role);
                // return $data->user->role;
            })
            ->make(true);
    }

    public function prosesPOLogistik(PurchaseOrder $purchaseOrder)
    {
        PurchaseOrder::where('id', $purchaseOrder->id)
        ->update([
            'status' => 'diproses'
        ]);
        return redirect('/logistik/purchase-order')->withSuccess('Data Berhasil Disimpan');
    }
}
