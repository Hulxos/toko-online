<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class PencarianController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::query();

        // 1. Filter berdasarkan Input Ketikan (Search)
        if ($request->has('cari') && $request->cari != '') {
            $query->where('NamaProduk', 'like', '%' . $request->cari . '%');
        }

        // 2. Filter berdasarkan Klik Kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        // 3. Ambil data: Stok > 0, Urutkan yang terbaru
        $produk = $query->where('Stok', '>', 0)->latest()->get();
        
        // 4. Ambil daftar kategori unik untuk tombol filter di atas
        $allKategori = Produk::distinct()->pluck('kategori');

        // 5. Kirim ke view (Pastikan folder: resources/views/admin/user/pencarian.blade.php)
        return view('admin.user.pencarian', compact('produk', 'allKategori'));
    }

    public function detail($id)
{
    // Cari produk berdasarkan ID, kalau tidak ada munculkan error 404
    $produk = Produk::where('ProdukID', $id)->firstOrFail();
    
    // Ambil produk lain sebagai rekomendasi (opsional)
    $rekomendasi = Produk::where('kategori', $produk->kategori)
                        ->where('ProdukID', '!=', $id)
                        ->limit(4)
                        ->get();

    return view('admin.user.detail', compact('produk', 'rekomendasi'));
}
}