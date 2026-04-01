<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BerandaController extends Controller
{
    public function index()
    {
        // 1. Ambil produk terbaru 
        // Note: Pakai 'ProdukID' dan 'Stok' sesuai foto database terbaru kamu
        $produkTerbaru = DB::table('produk')
            ->where('Stok', '>', 0) // S besar sesuai phpMyAdmin
            ->orderBy('ProdukID', 'desc') // P besar dan I besar sesuai phpMyAdmin
            ->limit(8)
            ->get();

        // 2. Ambil kategori unik (Buat icon kategori di beranda)
        $kategori = DB::table('produk')
            ->distinct()
            ->pluck('kategori')
            ->filter();

        // 3. Hitung keranjang (Biar icon keranjang ada angkanya)
        $jumlahKeranjang = 0;
        if (Session::has('pelanggan_id')) {
            $jumlahKeranjang = DB::table('keranjang')
                ->where('PelangganID', Session::get('pelanggan_id'))
                ->sum('jumlah') ?? 0;
        }

        // Pastikan file blade kamu ada di: resources/views/admin/user/beranda.blade.php
        return view('admin.user.beranda', compact('produkTerbaru', 'kategori', 'jumlahKeranjang'));
    }
}