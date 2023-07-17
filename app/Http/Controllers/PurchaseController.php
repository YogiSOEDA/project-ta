<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        return view('laporan');
    }
    public function requestMaterial()
    {
        return view('request-material');
    }
    public function purchase()
    {
        return view('purchase-order');
    }
}
