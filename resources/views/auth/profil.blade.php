@extends('admin.user.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container" style="padding: 20px;">
    <div style="background: white; border-radius: 15px; padding: 25px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h2 style="margin-bottom: 20px; color: #1a1f2e;">Profil Pengguna</h2>
        
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <div>
                <label style="font-weight: bold; color: #666;">Nama Lengkap</label>
                <p style="font-size: 16px; border-bottom: 1px solid #eee; padding-bottom: 5px;">{{ $user->NamaPelanggan }}</p>
            </div>

            <div>
                <label style="font-weight: bold; color: #666;">Email</label>
                <p style="font-size: 16px; border-bottom: 1px solid #eee; padding-bottom: 5px;">{{ $user->email }}</p>
            </div>

            <div>
                <label style="font-weight: bold; color: #666;">Nomor Telepon</label>
                <p style="font-size: 16px; border-bottom: 1px solid #eee; padding-bottom: 5px;">{{ $user->NomorTelepon }}</p>
            </div>

            <div>
                <label style="font-weight: bold; color: #666;">Alamat</label>
                <p style="font-size: 16px; border-bottom: 1px solid #eee; padding-bottom: 5px;">{{ $user->Alamat ?? 'Alamat belum diisi' }}</p>
            </div>

            <div>
                <label style="font-weight: bold; color: #666;">Status Akun</label>
                <p><span style="background: #e1f7e1; color: #2e7d32; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;">{{ strtoupper($user->role) }}</span></p>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <a href="{{ route('/') }}" style="background: #FF6B35; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold;">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection