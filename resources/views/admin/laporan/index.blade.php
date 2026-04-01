@extends('admin.layouts.app')

@section('title', 'Laporan')
@section('page_title', 'Laporan Penjualan & Pengiriman')
@section('page_sub', 'Ringkasan data pembayaran dan pengiriman')

@section('content')

<div style="padding:20px; background:#fff; border-radius:12px; box-shadow:0 0 20px rgba(0,0,0,0.05)">

    <h2 style="color:#f97316; margin-bottom:20px;">📊 Laporan Penjualan</h2>

    <table style="width:100%; border-collapse:collapse; margin-bottom:40px;">
        <thead style="background:linear-gradient(135deg,#f97316,#fb923c); color:white;">
            <tr>
                <th style="padding:12px;">ID</th>
                <th style="padding:12px;">Nama Pelanggan</th>
                <th style="padding:12px;">Metode</th>
                <th style="padding:12px;">Total</th>
                <th style="padding:12px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pembayaran as $p)
            <tr style="border-bottom:1px solid #e5e7eb;">
                <td style="padding:12px;">{{ $p->id }}</td>
                <td style="padding:12px;">{{ $p->nama }}</td>
                <td style="padding:12px;">{{ $p->metode }}</td>
                <td style="padding:12px;">Rp {{ number_format($p->total,0,',','.') }}</td>
                <td style="padding:12px;">
                    <span style="padding:4px 10px; border-radius:12px; color:white; background:
                        @if($p->status=='menunggu') #f59e0b
                        @elseif($p->status=='berhasil') #10b981
                        @else #6b7280
                        @endif
                        ">
                        {{ ucfirst($p->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center; padding:20px; color:#9ca3af;">Belum ada pembayaran</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2 style="color:#3b82f6; margin-bottom:20px;">🚚 Laporan Pengiriman</h2>

    <table style="width:100%; border-collapse:collapse;">
        <thead style="background:linear-gradient(135deg,#3b82f6,#60a5fa); color:white;">
            <tr>
                <th style="padding:12px;">ID</th>
                <th style="padding:12px;">Nama Pelanggan</th>
                <th style="padding:12px;">Alamat</th>
                <th style="padding:12px;">Metode</th>
                <th style="padding:12px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengiriman as $p)
            <tr style="border-bottom:1px solid #e5e7eb;">
                <td style="padding:12px;">{{ $p->id }}</td>
                <td style="padding:12px;">{{ $p->nama }}</td>
                <td style="padding:12px;">{{ $p->alamat }}</td>
                <td style="padding:12px;">{{ $p->metode }}</td>
                <td style="padding:12px;">
                    <span style="padding:4px 10px; border-radius:12px; color:white; background:
                        @if($p->status=='pending') #f59e0b
                        @elseif($p->status=='dikirim') #3b82f6
                        @elseif($p->status=='selesai') #10b981
                        @else #6b7280
                        @endif
                        ">
                        {{ ucfirst($p->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center; padding:20px; color:#9ca3af;">Belum ada pengiriman</td></tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection