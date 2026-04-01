<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total pendapatan dari penjualan yang sudah dibayar
        $totalPendapatan = DB::table('penjualan')
            ->where('status_pembayaran', 'sudah_bayar')
            ->sum('TotalHarga') ?? 0;

        // Total pesanan
        $totalPesanan = DB::table('penjualan')->count();

        // Total pelanggan (role user)
        $totalPelanggan = DB::table('pelanggan')->where('role', 'user')->count();

        // Total produk
        $totalProduk = DB::table('produk')->count();

        // Produk stok habis (stok <= 5)
        $stokHabis = DB::table('produk')->where('Stok', '<=', 5)->count();

        // Status pesanan untuk donut chart
        $statusPesanan = DB::table('penjualan')
            ->select('status_pesanan', DB::raw('count(*) as jumlah'))
            ->groupBy('status_pesanan')
            ->get();

        // Pesanan terbaru (5 data)
        $pesananTerbaru = DB::table('penjualan')
            ->join('pelanggan', 'penjualan.PelangganID', '=', 'pelanggan.PelangganID')
            ->select('penjualan.*', 'pelanggan.NamaPelanggan')
            ->orderBy('penjualan.created_at', 'desc')
            ->limit(5)
            ->get();

        // Stok produk (tampilkan 6 produk)
        $stokProduk = DB::table('produk')
            ->select('NamaProduk', 'Stok')
            ->orderBy('Stok', 'asc')
            ->limit(6)
            ->get();

        // Grafik penjualan 6 bulan terakhir
        $grafikPenjualan = [];
        $maxTotal = 1;

        for ($i = 5; $i >= 0; $i--) {
            $bulan = now()->subMonths($i);
            $total = DB::table('penjualan')
                ->whereYear('TanggalPenjualan', $bulan->year)
                ->whereMonth('TanggalPenjualan', $bulan->month)
                ->sum('TotalHarga') ?? 0;

            $grafikPenjualan[] = [
                'label' => $bulan->format('M'),
                'total' => $total,
                'persen' => 0,
            ];

            if ($total > $maxTotal) $maxTotal = $total;
        }

        // Hitung persentase untuk tinggi bar
        foreach ($grafikPenjualan as &$g) {
            $g['persen'] = $maxTotal > 0 ? round(($g['total'] / $maxTotal) * 100) : 0;
            if ($g['persen'] == 0 && $g['total'] == 0) $g['persen'] = 4;
        }

        return view('admin.dashboard', compact(
            'totalPendapatan',
            'totalPesanan',
            'totalPelanggan',
            'totalProduk',
            'stokHabis',
            'statusPesanan',
            'pesananTerbaru',
            'stokProduk',
            'grafikPenjualan'
        ));
    }
}