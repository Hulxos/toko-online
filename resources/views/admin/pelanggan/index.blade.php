@extends('admin.layouts.app')

@section('title', 'Pelanggan')
@section('page_title', 'Data Pelanggan')
@section('page_sub', 'Daftar pelanggan')

@section('content')

<style>
body {
    background: #ffffff;
}

.container-genz {
    background: #ffffff;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 0 30px rgba(143, 121, 121, 0.2);
}

.header-genz {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.header-genz h2 {
    color: white;
    margin: 0;
}

.btn-add {
    background: linear-gradient(135deg, #f97316, #fb923c);
    padding: 10px 18px;
    color: white;
    border-radius: 8px;
    font-size: 14px;
    text-decoration: none;
    transition: 0.3s;
    display: inline-block;
}

.btn-add:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(251,146,60,0.7);
}

.table-genz {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    border-radius: 12px;
}

.table-genz thead {
    background: linear-gradient(135deg, #f97316, #fb923c);
}

.table-genz th {
    padding: 14px;
    color: white;
    text-align: left;
    font-size: 13px;
}

.table-genz td {
    padding: 14px;
    color: #000000;
}

.table-genz tbody tr {
    border-bottom: 1px solid #44403c;
    transition: 0.2s;
}

.table-genz tbody tr:hover {
    background: rgba(251,146,60,0.1);
}

.badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    background: #f97316;
    color: white;
}

.avatar {
    width: 35px;
    height: 35px;
    background: linear-gradient(135deg, #f97316, #fb923c);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    margin-right: 10px;
}

.nama-box {
    display: flex;
    align-items: center;
}

.empty {
    text-align: center;
    padding: 30px;
    color: #000000;
}
</style>

<div class="container-genz">

    <div class="header-genz">
        <h2>✨ Data Pelanggan</h2>

        <!-- 🔥 TOMBOL SUDAH AKTIF -->
        <a href="{{ route('admin.pelanggan.create') }}" class="btn-add">
            + Tambah
        </a>
    </div>

    <table class="table-genz">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($pelanggan as $p)
            <tr>
                <td>{{ $p->PelangganID }}</td>

                <td>
                    <div class="nama-box">
                        <div class="avatar">
                            {{ strtoupper(substr($p->NamaPelanggan,0,1)) }}
                        </div>
                        {{ $p->NamaPelanggan }}
                    </div>
                </td>

                <td>{{ $p->email }}</td>
                <td>{{ $p->NomorTelepon }}</td>
                <td>{{ $p->Alamat }}</td>
                <td><span class="badge">Online</span></td>
            </tr>

            @empty
            <tr>
                <td colspan="6" class="empty">😢 Belum ada pelanggan</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection