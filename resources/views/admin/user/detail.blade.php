@extends('admin.user.app')

@section('title', $produk->NamaProduk)

@section('styles')
<style>
    .detail-container { background: white; min-height: 100vh; }
    .btn-back { position: absolute; top: 15px; left: 15px; background: rgba(0,0,0,0.5); color: white; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; z-index: 10; }
    
    .main-img { width: 100%; aspect-ratio: 1/1; object-fit: cover; }
    
    .info-section { padding: 20px; border-bottom: 8px solid #f5f5f5; }
    .price { color: #FF6B35; font-size: 24px; font-weight: 800; margin-bottom: 8px; }
    .product-title { font-size: 18px; color: #333; line-height: 1.4; margin-bottom: 15px; }
    
    .stock-info { display: flex; align-items: center; gap: 10px; font-size: 14px; color: #666; }
    .badge-stock { background: #fff0eb; color: #FF6B35; padding: 4px 8px; border-radius: 4px; font-weight: 600; }

    .desc-section { padding: 20px; padding-bottom: 100px; }
    .desc-title { font-weight: 700; margin-bottom: 10px; color: #333; }
    .desc-text { font-size: 14px; color: #666; line-height: 1.6; }

    /* Floating Bottom Bar */
    .bottom-action { position: fixed; bottom: 0; left: 0; right: 0; background: white; padding: 12px 20px; display: flex; gap: 12px; border-top: 1px solid #eee; z-index: 100; }
    .btn-wishlist { flex: 1; border: 1px solid #FF6B35; background: white; color: #FF6B35; padding: 12px; border-radius: 8px; font-weight: 700; cursor: pointer; text-align: center; text-decoration: none; }
    .btn-buy { flex: 2; background: #FF6B35; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 700; cursor: pointer; }
</style>
@endsection

@section('content')
<div class="detail-container">
    <a href="javascript:history.back()" class="btn-back">⬅️</a>
    
    <img src="{{ asset('storage/' . $produk->Foto) }}" class="main-img" alt="{{ $produk->NamaProduk }}">

    <div class="info-section">
        <div class="price">Rp {{ number_format($produk->Harga, 0, ',', '.') }}</div>
        <h1 class="product-title">{{ $produk->NamaProduk }}</h1>
        
        <div class="stock-info">
            <span>Stok tersedia:</span>
            <span class="badge-stock">{{ $produk->Stok }} pcs</span>
        </div>
    </div>

    <div class="desc-section">
        <div class="desc-title">Deskripsi Produk</div>
        <div class="desc-text">
            {{ $produk->Deskripsi ?? 'Tidak ada deskripsi untuk produk ini.' }}
        </div>
    </div>
</div>

<div class="bottom-action">
    <form action="{{ route('user.wishlist.toggle', $produk->ProdukID) }}" method="POST" style="flex: 1;">
        @csrf
        <button type="submit" class="btn-wishlist">❤️ Wishlist</button>
    </form>

    <form action="{{ route('user.keranjang.tambah', $produk->ProdukID) }}" method="POST" style="flex: 2;">
        @csrf
        <button type="submit" class="btn-buy">+ Keranjang</button>
    </form>
</div>
@endsection