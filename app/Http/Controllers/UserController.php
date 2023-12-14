<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\RequestMaterial;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user()->role;
        if ($user == 'admin') {
            $po = PurchaseOrder::where('status', '!=', 'selesai')->count();
            $rm = RequestMaterial::where('status', '!=', 'selesai')->count();

            return view('dashboard')->with([
                'po' => $po,
                'rm' => $rm
            ]);
        } elseif ($user == 'teknisi') {
            $rm = RequestMaterial::where('status', '!=', 'selesai')->count();

            return view('dashboard')->with([
                'rm' => $rm
            ]);
        } elseif ($user == 'direktur') {
            $po = PurchaseOrder::where('acc_direktur', '!=', 'divalidasi')->count();

            return view('dashboard')->with([
                'po' => $po
            ]);
        } elseif ($user == 'akunting') {
            $po = PurchaseOrder::where('acc_akunting', '!=', 'divalidasi')->count();

            return view('dashboard')->with([
                'po' => $po
            ]);
        } elseif ($user == 'logistik') {
            $po = PurchaseOrder::where('status', '!=', 'selesai')
                ->where('acc_direktur', 'divalidasi')
                ->where('acc_akunting', 'divalidasi')
                ->count();
            $rm = RequestMaterial::where('status', 'diproses')->count();

            return view('dashboard')->with([
                'po' => $po,
                'rm' => $rm
            ]);
        }
        // dd($user);
    }

    public function login()
    {
        return view('login');
    }

    public function postlogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $is_active = 'is_active';

        $credentials[$is_active] = 1;
        // dd($credentials);

        if (Auth::attempt($credentials)) {
            // if (Auth::attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();
            // return redirect('/dashboard');
            return redirect()->intended('/dashboard');
            // return redirect()->intended('/dashboard')->with('success', 'Login Berhasil');
            // return alert()->success
        }
        // return redirect('/login');

        return back()->with('error', 'Login Gagal!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login');
    }

    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
            'password' => bcrypt($request->password),
            'is_active' => 1,
        ]);

        return view('login');
    }

    public function viewDataUser()
    {
        return view('user.user');
    }

    public function table()
    {
        $user = User::query();
        return DataTables::of($user)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                if ($data->is_active == 1) {
                    return '<p class="badge badge-success">Aktif</p>';
                }
                return '<p class="badge badge-danger">Nonaktif</p>';
            })
            ->addColumn('action', function ($data) {
                if ($data->is_active == 0) {
                    return '<button class="btn btn-success" onclick="status(' . $data->id . ')"> Aktifkan</button> <button class="btn btn-warning" onclick="show(' . $data->id . ')"><i class="fas fa-pen"></i> Edit</button>';
                }
                return '<button class="btn btn-danger" onclick="status(' . $data->id . ')"> Nonaktifkan</button> <button class="btn btn-warning" onclick="show(' . $data->id . ')"><i class="fas fa-pen"></i> Edit</button>';
                // return view('template.btn-action')->with(['data' => $data]); //'<button class="btn btn-warning" onclick="show('.$data->id.')"><i class="fas fa-pen"></i> Edit</button>';  //'<a href="#" class="btn btn-warning"><i class="fas fa-pen"></i> Edit</a>';
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function create()
    {
        return view('user.create-user');
    }

    public function show(User $user)
    {
        return view('user.update-user')->with([
            'data' => $user
        ]);
    }

    public function updateStatus(User $user)
    {
        if ($user->is_active == 0) {
            User::where('id', $user->id)
                ->update([
                    'is_active' => 1,
                ]);
        } else {
            User::where('id', $user->id)
                ->update([
                    'is_active' => 0,
                ]);
        }
    }

    public function update(Request $request, User $user)
    {
        User::where('id', $user->id)
            ->update([
                'name' => $request->name,
                'username' => $request->username,
                'role' => $request->role,
            ]);
    }

    public function store(Request $request)
    {
        // return $request;
        // dd($request);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
            'password' => bcrypt($request->password),
            'is_active' => 1,
        ]);

        return redirect('/data-user')->withSuccess('Data Berhasil Disimpan');
    }
}
