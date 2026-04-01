@extends('admin.user.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')
@section('page_sub', 'Selamat datang kembali, ' . Session::get('nama_pelanggan', 'Admin') . '!')

@section('styles')
<style>
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px; margin-bottom: 24px; }
    .stat-card { background: white; border-radius: 14px; padding: 20px; position: relative; overflow: hidden; border: 1px solid #f0f0f0; }
    .stat-card::after { content: ''; position: absolute; width: 80px; height: 80px; border-radius: 50%; top: -20px; right: -20px; opacity: 0.08; }
    .stat-card.orange::after { background: #FF6B35; }
    .stat-card.blue::after { background: #3b82f6; }
    .stat-card.green::after { background: #22c55e; }
    .stat-card.purple::after { background: #a855f7; }
    .stat-icon { font-size: 24px; margin-bottom: 12px; }
    .stat-label { font-size: 12px; color: #999; margin-bottom: 6px; font-weight: 500; letter-spacing: 0.3px; }
    .stat-value { font-size: 24px; font-weight: 800; color: #1a1f2e; margin-bottom: 6px; }
    .stat-change { font-size: 11px; font-weight: 600; }
    .stat-change.up { color: #22c55e; }
    .stat-change.down { color: #ef4444; }

    .grid2 { display: grid; grid-template-columns: 1.6fr 1fr; gap: 16px; margin-bottom: 24px; }
    .card { background: white; border-radius: 14px; padding: 20px; border: 1px solid #f0f0f0; }
    .card-title { font-size: 14px; font-weight: 700; color: #1a1f2e; margin-bottom: 16px; display: flex; align-items: center; justify-content: space-between; }
    .card-title a { font-size: 11px; color: #FF6B35; font-weight: 600; text-decoration: none; }

    .bar-chart { display: flex; align-items: flex-end; gap: 8px; height: 150px; padding-top: 10px; }
    .bar-wrap { flex: 1; display: flex; flex-direction: column; align-items: center; gap: 6px; height: 100%; justify-content: flex-end; }
    .bar { width: 100%; border-radius: 6px 6px 0 0; opacity: 0.85; transition: opacity 0.2s; min-height: 4px; }
    .bar:hover { opacity: 1; }
    .bar-hot { background: #FF6B35; }
    .bar-warm { background: #ff9a6c; }
    .bar-cool { background: #ffcba4; }
    .bar[data-height="1"] { height: 1%; }
    .bar[data-height="10"] { height: 10%; }
    .bar[data-height="20"] { height: 20%; }
    .bar[data-height="30"] { height: 30%; }
    .bar[data-height="40"] { height: 40%; }
    .bar[data-height="50"] { height: 50%; }
    .bar[data-height="60"] { height: 60%; }
    .bar[data-height="70"] { height: 70%; }
    .bar[data-height="80"] { height: 80%; }
    .bar[data-height="90"] { height: 90%; }
    .bar[data-height="100"] { height: 100%; }
    .bar-label { font-size: 11px; color: #aaa; }
    .bar-amount { font-size: 10px; color: #888; font-weight: 600; }

    .donut-wrap { display: flex; flex-direction: column; align-items: center; gap: 16px; }
    .donut-legend { width: 100%; display: flex; flex-direction: column; gap: 10px; }
    .legend-item { display: flex; align-items: center; justify-content: space-between; font-size: 13px; }
    .legend-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
    .dot-green { background: #22c55e; }
    .dot-blue { background: #3b82f6; }
    .dot-purple { background: #a855f7; }
    .dot-amber { background: #f59e0b; }
    .dot-red { background: #ef4444; }
    .dot-gray { background: #999; }
    .legend-left { display: flex; align-items: center; gap: 8px; color: #555; }
    .legend-val { font-weight: 700; color: #1a1f2e; }

    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; font-size: 13px; }
    th { text-align: left; padding: 10px 12px; font-size: 11px; font-weight: 700; color: #aaa; letter-spacing: 0.5px; border-bottom: 2px solid #f0f0f0; }
    td { padding: 13px 12px; border-bottom: 1px solid #f8f8f8; color: #333; }
    tr:last-child td { border-bottom: none; }
    tr:hover td { background: #fafbff; }
    .badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
    .badge.selesai { background: #dcfce7; color: #16a34a; }
    .badge.dikirim { background: #dbeafe; color: #2563eb; }
    .badge.pending { background: #fef9c3; color: #ca8a04; }
    .badge.diproses { background: #f3e8ff; color: #9333ea; }
    .badge.dibatalkan { background: #fee2e2; color: #dc2626; }

    .produk-stok { display: flex; flex-direction: column; gap: 12px; }
    .stok-item { display: flex; align-items: center; gap: 12px; }
    .stok-nama { flex: 1; font-size: 13px; color: #333; }
    .stok-bar-wrap { width: 100px; height: 6px; background: #f0f0f0; border-radius: 3px; }
    .stok-bar { height: 6px; border-radius: 3px; }
    .stok-critical { background: #ef4444; }
    .stok-warning { background: #f59e0b; }
    .stok-good { background: #22c55e; }
    .stok-bar[data-width="5"] { width: 5%; }
    .stok-bar[data-width="10"] { width: 10%; }
    .stok-bar[data-width="15"] { width: 15%; }
    .stok-bar[data-width="20"] { width: 20%; }
    .stok-bar[data-width="30"] { width: 30%; }
    .stok-bar[data-width="40"] { width: 40%; }
    .stok-bar[data-width="50"] { width: 50%; }
    .stok-bar[data-width="60"] { width: 60%; }
    .stok-bar[data-width="70"] { width: 70%; }
    .stok-bar[data-width="80"] { width: 80%; }
    .stok-bar[data-width="90"] { width: 90%; }
    .stok-bar[data-width="100"] { width: 100%; }
    .stok-num { font-size: 12px; font-weight: 700; width: 30px; text-align: right; }
    .text-red { color: #ef4444; }
    .text-amber { color: #f59e0b; }
    .text-green { color: #22c55e; }

    @media (max-width: 1024px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .grid2 { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

{{-- KARTU STATISTIK --}}
<div class="stats-grid">
    <div class="stat-card orange">
        <div class="stat-icon">💰</div>
        <div class="stat-label">TOTAL PENDAPATAN</div>
        <div class="stat-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
        <div class="stat-change up">↑ Data real dari database</div>
    </div>
    <div class="stat-card blue">
        <div class="stat-icon">🛒</div>
        <div class="stat-label">TOTAL PESANAN</div>
        <div class="stat-value">{{ $totalPesanan }}</div>
        <div class="stat-change up">↑ Semua status pesanan</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon">👥</div>
        <div class="stat-label">TOTAL PELANGGAN</div>
        <div class="stat-value">{{ $totalPelanggan }}</div>
        <div class="stat-change up">↑ Pelanggan terdaftar</div>
    </div>
    <div class="stat-card purple">
        <div class="stat-icon">📦</div>
        <div class="stat-label">TOTAL PRODUK</div>
        <div class="stat-value">{{ $totalProduk }}</div>
        <div class="stat-change {{ $stokHabis > 0 ? 'down' : 'up' }}">
            {{ $stokHabis > 0 ? '↓ ' . $stokHabis . ' produk habis' : '✓ Semua stok tersedia' }}
        </div>
    </div>
</div>

{{-- GRAFIK + DONUT --}}
<div class="grid2">
    {{-- Grafik Penjualan --}}
    <div class="card">
        <div class="card-title">
            Grafik Penjualan (6 Bulan Terakhir)
            <a href="{{ route('admin.laporan') }}">Lihat Laporan →</a>
        </div>
        <div class="bar-chart">
            @foreach($grafikPenjualan as $bulan)
            @php
                $barBg = $bulan['persen'] > 80 ? 'bar-hot' : ($bulan['persen'] > 50 ? 'bar-warm' : 'bar-cool');
                $barHeight = 'bar-h' . (int)$bulan['persen'];
            @endphp
            <div class="bar-wrap">
                <div class="bar-amount">{{ $bulan['total'] > 0 ? 'Rp' . number_format($bulan['total']/1000, 0) . 'rb' : '-' }}</div>
                <div class="bar {{ $barBg }}" data-height="{{ $bulan['persen'] }}"></div>
                <div class="bar-label">{{ $bulan['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Status Pesanan Donut --}}
    <div class="card">
        <div class="card-title">Status Pesanan</div>
        <div class="donut-wrap">
            <svg viewBox="0 0 36 36" style="width:130px;height:130px">
                <circle cx="18" cy="18" r="15.9" fill="none" stroke="#f0f0f0" stroke-width="3.5"/>
                @php
                    $offset = 25;
                    $colors = ['selesai'=>'#22c55e','dikirim'=>'#3b82f6','diproses'=>'#a855f7','pending'=>'#f59e0b','dibatalkan'=>'#ef4444'];
                    $total_p = $statusPesanan->sum('jumlah') ?: 1;
                @endphp
                @foreach($statusPesanan as $s)
                @php
                    $persen = ($s->jumlah / $total_p) * 100;
                    $color = $colors[$s->status_pesanan] ?? '#ccc';
                @endphp
                <circle cx="18" cy="18" r="15.9" fill="none" stroke="{{ $color }}" stroke-width="3.5"
                    stroke-dasharray="{{ $persen }} 100"
                    stroke-dashoffset="{{ -$offset + 25 }}"
                    transform="rotate(-90 18 18)"/>
                @php $offset += $persen; @endphp
                @endforeach
            </svg>
            <div class="donut-legend">
                @foreach($statusPesanan as $s)
                @php
                    $persen2 = round(($s->jumlah / $total_p) * 100);
                    $dotClass = match($s->status_pesanan) {
                        'selesai' => 'dot-green',
                        'dikirim' => 'dot-blue',
                        'diproses' => 'dot-purple',
                        'pending' => 'dot-amber',
                        'dibatalkan' => 'dot-red',
                        default => 'dot-gray',
                    };
                @endphp
                <div class="legend-item">
                    <div class="legend-left"><div class="legend-dot {{ $dotClass }}"></div>{{ ucfirst($s->status_pesanan) }}</div>
                    <div class="legend-val">{{ $s->jumlah }} ({{ $persen2 }}%)</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- TABEL + STOK --}}
<div class="grid2">
    {{-- Pesanan Terbaru --}}
    <div class="card">
        <div class="card-title">
            Pesanan Terbaru
            <a href="{{ route('admin.pesanan') }}">Lihat Semua →</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>#ID</th><th>PELANGGAN</th><th>TOTAL</th><th>STATUS</th><th>TANGGAL</th></tr>
                </thead>
                <tbody>
                    @forelse($pesananTerbaru as $p)
                    <tr>
                        <td>#{{ str_pad($p->PenjualanID, 3, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $p->NamaPelanggan }}</td>
                        <td>Rp {{ number_format($p->TotalHarga, 0, ',', '.') }}</td>
                        <td><span class="badge {{ $p->status_pesanan }}">{{ ucfirst($p->status_pesanan) }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($p->TanggalPenjualan)->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center;color:#aaa;padding:20px">Belum ada pesanan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Stok Produk --}}
    <div class="card">
        <div class="card-title">
            Stok Produk
            <a href="{{ route('admin.produk') }}">Kelola →</a>
        </div>
        <div class="produk-stok">
            @forelse($stokProduk as $p)
            @php
                $maxStok = 100;
                $persen3 = min(($p->Stok / $maxStok) * 100, 100);
                $stokColorClass = $p->Stok <= 5 ? 'stok-critical' : ($p->Stok <= 15 ? 'stok-warning' : 'stok-good');
                $stokTextClass = $p->Stok <= 5 ? 'text-red' : ($p->Stok <= 15 ? 'text-amber' : 'text-green');
            @endphp
            <div class="stok-item">
                <div class="stok-nama">{{ \Illuminate\Support\Str::limit($p->NamaProduk, 22) }}</div>
                <div class="stok-bar-wrap"><div class="stok-bar {{ $stokColorClass }}" data-width="{{ (int)$persen3 }}"></div></div>
                <div class="stok-num {{ $stokTextClass }}">{{ $p->Stok }}</div>
            </div>
            @empty
            <p style="color:#aaa;font-size:13px">Belum ada produk</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
