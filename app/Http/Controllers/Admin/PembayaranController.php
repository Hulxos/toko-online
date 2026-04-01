<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function index()
    {
        // ambil dari database (kalau belum ada tabel, nanti fallback dummy)
        try {
            $pembayaran = DB::table('pembayaran')->get();
        } catch (\Exception $e) {
            // dummy kalau tabel belum ada
            $pembayaran = collect([
                (object)[
                    'id' => 1,
                    'nama' => 'Zanza',
                    'metode' => 'Transfer',
                    'total' => 250000,
                    'status' => 'menunggu'
                ],
                (object)[
                    'id' => 2,
                    'nama' => 'Budi',
                    'metode' => 'COD',
                    'total' => 150000,
                    'status' => 'berhasil'
                ],
            ]);
        }

        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    public function update(Request $request, $id)
    {
        DB::table('pembayaran')->where('id', $id)->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pembayaran diupdate!');
    }
}