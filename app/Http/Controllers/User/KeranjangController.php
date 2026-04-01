<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KeranjangController extends Controller
{
    public function index()
    {
        $pelangganId = Session::get('pelanggan_id');
        
        // Cek jika belum login, lempar ke halaman login
        if (!$pelangganId) {
            return redirect()->route('user.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data keranjang join dengan tabel produk
        $keranjang = DB::table('keranjang')
            ->join('produk', 'keranjang.ProdukID', '=', 'produk.ProdukID')
            ->where('keranjang.PelangganID', $pelangganId)
            ->select('keranjang.*', 'produk.NamaProduk', 'produk.Harga', 'produk.Foto')
            ->get();

        // Hitung total harga otomatis
        $totalHarga = $keranjang->sum(function($item) {
            return $item->Harga * $item->Jumlah;
        });

        // SESUAIKAN JALUR VIEW: karena user di dalam admin
        return view('admin.user.keranjang', compact('keranjang', 'totalHarga'));
    }

    public function tambah(Request $request, $id)
{
    // Cek apakah user sudah login melalui session
    if (!session()->has('pelanggan_id')) {
        return redirect()->route('user.login')->with('error', 'Login dulu yuk!');
    }

    $pelangganId = session()->get('pelanggan_id');

    // Cek apakah barang sudah ada di keranjang untuk user ini
    $item = DB::table('keranjang')
        ->where('PelangganID', $pelangganId)
        ->where('ProdukID', $id)
        ->first();

    if ($item) {
        // Jika sudah ada, tambah jumlahnya saja
        DB::table('keranjang')->where('KeranjangID', $item->KeranjangID)->increment('jumlah', 1);
    } else {
        // Jika belum ada, buat baris baru di tabel keranjang
        DB::table('keranjang')->insert([
            'PelangganID' => $pelangganId,
            'ProdukID'    => $id,
            'jumlah'      => 1,
            'created_at'  => now()
        ]);
    }

    return redirect()->route('user.keranjang')->with('success', 'Barang berhasil masuk keranjang! 🛒');
}

    public function hapus($id)
    {
        DB::table('keranjang')->where('KeranjangID', $id)->delete();
        return back()->with('success', 'Produk dihapus dari keranjang!');
    }
}