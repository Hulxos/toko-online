<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pengiriman;

class LaporanController extends Controller
{
    public function index()
    {
        // Ambil semua data dari database
        $pembayaran = Pembayaran::all();
        $pengiriman = Pengiriman::all();

        return view('admin.laporan.index', compact('pembayaran', 'pengiriman'));
    }
}