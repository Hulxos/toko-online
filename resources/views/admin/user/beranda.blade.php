@extends('admin.user.app')

@section('title', 'Beranda - TokoKu')

@section('styles')
<style>
    /* Style tetap sama seperti punyamu karena sudah bagus */
    .banner { margin: 12px 16px; border-radius: 14px; background: #FF6B35; padding: 20px 24px; color: white; position: relative; overflow: hidden; }
    .banner-bg { position: absolute; right: 16px; top: 50%; transform: translateY(-50%); font-size: 70px; opacity: 0.15; }
    .banner-title { font-size: 18px; font-weight: 800; margin-bottom: 4px; }
    .banner-sub { font-size: 12px; opacity: 0.9; margin-bottom: 14px; }
    .banner-btn { background: white; color: #FF6B35; border: none; padding: 8px 18px; border-radius: 20px; font-size: 12px; font-weight: 700; cursor: pointer; text-decoration: none; display: inline-block; }
    .section { padding: 12px 16px; }
    .section-title { font-size: 14px; font-weight: 700; color: #1a1f2e; margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center; }
    .section-title a { font-size: 12px; color: #FF6B35; font-weight: 600; text-decoration: none; }
    .kategori-scroll { display: flex; gap: 12px; overflow-x: auto; padding-bottom: 4px; }
    .kategori-scroll::-webkit-scrollbar { display: none; }
    .kat-item { display: flex; flex-direction: column; align-items: center; gap: 6px; flex-shrink: 0; text-decoration: none; }
    .kat-icon { width: 56px; height: 56px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 26px; }
    .kat-label { font-size: 11px; color: #555; font-weight: 500; }
    .promo-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; padding: 0 16px; margin-bottom: 8px; }
    .promo-card { border-radius: 12px; padding: 14px; color: white; position: relative; overflow: hidden; }
    .promo-card.merah { background: #ef4444; }
    .promo-card.biru { background: #3b82f6; }
    .promo-emoji { position: absolute; right: 8px; top: 8px; font-size: 30px; opacity: 0.25; }
    .promo-judul { font-size: 13px; font-weight: 700; margin-bottom: 2px; }
    .promo-sub { font-size: 10px; opacity: 0.85; }
    .produk-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
    .produk-card { background: white; border-radius: 12px; overflow: hidden; text-decoration: none; display: block; border: 1px solid #f0f0f0; }
    .produk-img-wrap { width: 100%; height: 130px; background: #f8f8f8; display: flex; align-items: center; justify-content: center; font-size: 50px; position: relative; overflow: hidden; }
    .produk-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
    .produk-badge { position: absolute; top: 8px; left: 8px; background: #FF6B35; color: white; font-size: 10px; font-weight: 700; padding: 2px 8px; border-radius: 20px; }
    .produk-info { padding: 10px; }
    .produk-nama { font-size: 13px; color: #333; margin-bottom: 4px; font-weight: 500; line-height: 1.3; }
    .produk-harga { font-size: 15px; font-weight: 800; color: #FF6B35; margin-bottom: 4px; }
    .produk-meta { font-size: 11px; color: #aaa; }
    .kosong { text-align: center; padding: 40px; color: #aaa; font-size: 14px; grid-column: span 2; }
</style>
@endsection

@section('content')

{{-- BANNER --}}
<div class="banner">
    <div class="banner-bg">🛍️</div>
    <div class="banner-title">Selamat Datang! 👋</div>
    <div class="banner-sub">Temukan produk terbaik dengan harga terjangkau</div>
    <a href="{{ route('user.pencarian') }}" class="banner-btn">Belanja Sekarang</a>
</div>

{{-- KATEGORI --}}
<div class="section">
    <div class="section-title">
        Kategori
        <a href="{{ route('user.pencarian') }}">Lihat Semua</a>
    </div>
    <div class="kategori-scroll">
        @php
            $ikonKat = [
                'Pakaian'    => ['icon' => '👔', 'bg' => '#fff0eb'],
                'Sepatu'     => ['icon' => '👟', 'bg' => '#eff6ff'],
                'Tas'        => ['icon' => '🎒', 'bg' => '#f0fdf4'],
                'Aksesoris'  => ['icon' => '⌚', 'bg' => '#faf5ff'],
                'Elektronik' => ['icon' => '📱', 'bg' => '#fff0f6'],
                'Lainnya'    => ['icon' => '📦', 'bg' => '#f8f8f8'],
            ];
        @endphp
        @forelse($kategori as $kat)
        @php $info = $ikonKat[$kat] ?? ['icon' => '📦', 'bg' => '#f8f8f8']; @endphp
        <a href="{{ route('user.pencarian', ['kategori' => $kat]) }}" class="kat-item">
            <div class="kat-icon" style="background-color: {{ $info['bg'] }};">
                {{ $info['icon'] }}
            </div>
            <div class="kat-label">{{ $kat }}</div>
        </a>
        @empty
        <p style="color:#aaa;font-size:13px">Belum ada kategori</p>
        @endforelse
    </div>
</div>

{{-- PROMO --}}
<div class="promo-row">
    <div class="promo-card merah">
        <div class="promo-emoji">🔥</div>
        <div class="promo-judul">Flash Sale</div>
        <div class="promo-sub">Diskon spesial hari ini</div>
    </div>
    <div class="promo-card biru">
        <div class="promo-emoji">🚚</div>
        <div class="promo-judul">Gratis Ongkir</div>
        <div class="promo-sub">Min. belanja Rp50rb</div>
    </div>
</div>

{{-- PRODUK TERBARU --}}
<div class="produk-grid">
    @forelse($produkTerbaru as $p)
    {{-- FIX: Gunakan ProdukID (Huruf P, I, dan D Besar!) --}}
    <a href="{{ route('user.produk.detail', $p->ProdukID) }}" class="produk-card">
        <div class="produk-img-wrap">
            {{-- FIX: Gunakan foto (sesuai phpMyAdmin kamu) --}}
            @if($p->foto && file_exists(public_path('storage/' . $p->foto)))
                <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->NamaProduk }}">
            @else
                <div style="font-size: 50px;">📦</div>
            @endif
            
            @if(($p->total_terjual ?? 0) > 50)
                <div class="produk-badge">HOT</div>
            @endif
        </div>
        <div class="produk-info">
    <div class="produk-nama">{{ Str::limit($p->NamaProduk, 30) }}</div>
    <div class="produk-harga">Rp {{ number_format($p->Harga, 0, ',', '.') }}</div>
    
    <form action="{{ route('user.keranjang.tambah', $p->ProdukID) }}" method="POST">
        @csrf
        <button type="submit" style="width:100%; background:#FF6B35; color:white; border:none; padding:8px; border-radius:8px; cursor:pointer; font-weight:bold; margin-top:8px;">
            + Keranjang
        </button>
    </form>
</div>
</div>

@endsection