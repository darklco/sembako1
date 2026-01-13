<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function riwayat()
    {
        return view('users.riwayat');
    }

    public function pembayaran()
    {
        return view('users.pembayaran');
    }
}
