<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\RequestMaterial;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect('/dashboard');
        }
        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return view('login');
    }
}
