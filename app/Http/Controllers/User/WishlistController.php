<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function index()
    {
        $pelangganId = Session::get('pelanggan_id');
        if (!$pelangganId) return redirect()->route('user.login');

        // Ambil data wishlist join dengan produk
        $wishlist = DB::table('wishlist')
            ->join('produk', 'wishlist.ProdukID', '=', 'produk.ProdukID')
            ->where('wishlist.PelangganID', $pelangganId)
            ->select('wishlist.WishlistID', 'produk.*')
            ->get();

        return view('admin.user.wishlist', compact('wishlist'));
    }

    public function toggle($id)
    {
        $pelangganId = Session::get('pelanggan_id');
        if (!$pelangganId) return response()->json(['error' => 'Login dulu!'], 401);

        $cek = DB::table('wishlist')
            ->where('PelangganID', $pelangganId)
            ->where('ProdukID', $id)
            ->first();

        if ($cek) {
            DB::table('wishlist')->where('WishlistID', $cek->WishlistID)->delete();
            return back()->with('success', 'Dihapus dari wishlist');
        } else {
            DB::table('wishlist')->insert([
                'PelangganID' => $pelangganId,
                'ProdukID' => $id,
                'created_at' => now()
            ]);
            return back()->with('success', 'Ditambah ke wishlist');
        }
    }
}