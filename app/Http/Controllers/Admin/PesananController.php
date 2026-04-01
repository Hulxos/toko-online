<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        // Berdasarkan foto phpMyAdmin kamu:
        // Kolomnya adalah: id, nama, produk, total, status
        $pesanan = DB::table('pesanan')
            ->select('id', 'nama', 'produk', 'total', 'status')
            ->orderBy('id', 'desc') // Urutin pakai 'id' saja karena 'created_at' gak ada
            ->get();

        return view('admin.pesanan.index', compact('pesanan'));
    }

    public function show($id)
    {
        // Ambil data pesanan tunggal
        $pesanan = DB::table('pesanan')->where('id', $id)->first();

        // Kita kosongkan detail dulu supaya gak error 'Column Not Found' lagi
        $detail = []; 

        return view('admin.pesanan.detail', compact('detail', 'pesanan'));
    }

    public function update(Request $request, $id)
    {
        // Di foto phpMyAdmin, kolom status kamu huruf kecil semua 'status'
        DB::table('pesanan')->where('id', $id)->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}