@extends('admin.layouts.app'){{-- Pastikan nama layout admin kamu benar --}}

@section('title', 'Dashboard - TokoKu')

@section('content')
<div style="padding: 20px; background: #f8f9fa;">
    <h2 style="margin-bottom: 20px;">Dashboard Overview</h2>

    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
        <div style="background: white; padding: 20px; border-radius: 12px; border-left: 5px solid #FF6B35; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <div style="font-size: 14px; color: #888;">Total Pendapatan</div>
            <div style="font-size: 20px; font-weight: bold; color: #333;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
        </div>
        <div style="background: white; padding: 20px; border-radius: 12px; border-left: 5px solid #4e73df; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <div style="font-size: 14px; color: #888;">Total Pesanan</div>
            <div style="font-size: 20px; font-weight: bold; color: #333;">{{ $totalPesanan }}</div>
        </div>
        <div style="background: white; padding: 20px; border-radius: 12px; border-left: 5px solid #1cc88a; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <div style="font-size: 14px; color: #888;">Total Pelanggan</div>
            <div style="font-size: 20px; font-weight: bold; color: #333;">{{ $totalPelanggan }}</div>
        </div>
        <div style="background: white; padding: 20px; border-radius: 12px; border-left: 5px solid #e74a3b; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <div style="font-size: 14px; color: #888;">Stok Hampir Habis</div>
            <div style="font-size: 20px; font-weight: bold; color: #e74a3b;">{{ $stokHabis }} Produk</div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px;">
        <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <h4 style="margin-bottom: 15px;">Pesanan Terbaru</h4>
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="border-bottom: 1px solid #eee; text-align: left;">
                        <th style="padding: 10px;">ID</th>
                        <th style="padding: 10px;">Pelanggan</th>
                        <th style="padding: 10px;">Total</th>
                        <th style="padding: 10px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesananTerbaru as $p)
                    <tr style="border-bottom: 1px solid #f9f9f9;">
                        <td style="padding: 10px;">#{{ $p->PenjualanID }}</td>
                        <td style="padding: 10px;">{{ $p->NamaPelanggan }}</td>
                        <td style="padding: 10px;">Rp {{ number_format($p->TotalHarga) }}</td>
                        <td style="padding: 10px;">
                            <span style="padding: 4px 8px; border-radius: 4px; font-size: 11px; background: #eee;">
                                {{ $p->status_pesanan }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <h4 style="margin-bottom: 15px;">Grafik Penjualan</h4>
            <div style="display: flex; align-items: flex-end; height: 150px; gap: 10px; justify-content: space-around;">
                @foreach($grafikPenjualan as $g)
                <div style="text-align: center; flex: 1;">
                    <div style="background: #FF6B35; height: {{ $g['persen'] }}px; border-radius: 4px 4px 0 0;" title="Rp {{ number_format($g['total']) }}"></div>
                    <div style="font-size: 10px; margin-top: 5px;">{{ $g['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection