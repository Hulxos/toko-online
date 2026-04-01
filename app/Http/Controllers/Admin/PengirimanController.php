<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengirimanController extends Controller
{
    // Tampilkan semua pengiriman
    public function index()
    {
        try {
            $pengiriman = DB::table('pengiriman')->get();
        } catch (\Exception $e) {
            // fallback dummy jika tabel belum ada
            $pengiriman = collect([
                (object)[
                    'id' => 1,
                    'nama' => 'Zanza',
                    'alamat' => 'Jl. Merpati No.10',
                    'metode' => 'JNE',
                    'status' => 'pending'
                ],
                (object)[
                    'id' => 2,
                    'nama' => 'Budi',
                    'alamat' => 'Jl. Kenanga No.5',
                    'metode' => 'GO-SEND',
                    'status' => 'dikirim'
                ],
            ]);
        }

        return view('admin.pengiriman.index', compact('pengiriman'));
    }

    // Update status pengiriman
    public function update(Request $request, $id)
    {
        $statusBaru = $request->status;

        try {
            DB::table('pengiriman')->where('id', $id)->update([
                'status' => $statusBaru
            ]);
        } catch (\Exception $e) {
            // fallback jika tabel belum ada
            return back()->with('error', 'Tabel pengiriman belum tersedia.');
        }

        return back()->with('success', "Status pengiriman diupdate menjadi '{$statusBaru}'!");
    }
}