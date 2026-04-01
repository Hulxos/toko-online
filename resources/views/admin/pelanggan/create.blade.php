@extends('admin.layouts.app')

@section('title', 'Tambah Pelanggan')
@section('page_title', 'Tambah Pelanggan')
@section('page_sub', 'Form input pelanggan baru')

@section('styles')
<style>
    .form-container { max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 16px; border: 1px solid #f0f0f0; }
    .form-title { color: #f97316; margin-bottom: 25px; text-align: center; font-weight: 800; font-size: 20px; }
    .input-group { margin-bottom: 18px; }
    .input-group label { display: block; margin-bottom: 6px; color: #ea580c; font-size: 13px; font-weight: 600; }
    .input-group input, .input-group textarea { width: 100%; padding: 12px 14px; border-radius: 10px; border: 1.5px solid #fed7aa; outline: none; background: #fff7ed; color: #444; font-size: 13px; font-family: inherit; transition: 0.2s; }
    .input-group input:focus, .input-group textarea:focus { border-color: #f97316; background: white; box-shadow: 0 0 0 3px rgba(249,115,22,0.1); }
    .input-group textarea { resize: vertical; min-height: 80px; }
    .btn-submit { width: 100%; padding: 13px; border: none; border-radius: 10px; background: #f97316; color: white; font-size: 15px; cursor: pointer; font-weight: 700; transition: 0.2s; }
    .btn-submit:hover { background: #ea580c; transform: translateY(-1px); }
    .btn-back { display: inline-block; margin-bottom: 20px; color: #f97316; text-decoration: none; font-size: 13px; font-weight: 600; }
    .btn-back:hover { text-decoration: underline; }
    .alert-error { background: #fff2f2; border: 1px solid #ffcdd2; border-radius: 10px; padding: 12px 16px; color: #c62828; font-size: 13px; margin-bottom: 20px; }
</style>
@endsection

@section('content')
<div class="form-container">
    <a href="{{ route('admin.pelanggan') }}" class="btn-back">← Kembali</a>
    <h2 class="form-title">🧡 Tambah Pelanggan</h2>

    @if ($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('admin.pelanggan.store') }}" method="POST">
        @csrf
        <div class="input-group">
            <label>NAMA LENGKAP *</label>
            <input type="text" name="nama" placeholder="Masukkan nama lengkap..." value="{{ old('nama') }}" required>
        </div>
        <div class="input-group">
            <label>EMAIL</label>
            <input type="email" name="email" placeholder="contoh@email.com" value="{{ old('email') }}">
        </div>
        <div class="input-group">
            <label>NO. TELEPON</label>
            <input type="text" name="no_hp" placeholder="08xxxxxxxxxx" value="{{ old('no_hp') }}">
        </div>
        <div class="input-group">
            <label>ALAMAT</label>
            <textarea name="alamat" placeholder="Masukkan alamat lengkap...">{{ old('alamat') }}</textarea>
        </div>
        <div class="input-group">
            <label>PASSWORD</label>
            <input type="password" name="password" placeholder="Kosongkan jika pakai default (password123)">
        </div>
        <button type="submit" class="btn-submit">💾 Simpan Data</button>
    </form>
</div>
@endsection