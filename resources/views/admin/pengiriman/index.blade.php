@extends('admin.layouts.app')

@section('title', 'Pengiriman')
@section('page_title', 'Data Pengiriman')
@section('page_sub', 'Daftar pengiriman')

@section('content')

<style>
/* Container card */
.container-genz {
    background: #ffffff;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 0 30px rgba(143, 121, 121, 0.1);
    margin-top: 20px;
}

/* Header */
.header-genz {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.header-genz h2 {
    color: #f97316;
    font-weight: bold;
    margin: 0;
}

/* Table */
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
    font-size: 14px;
}

.table-genz td {
    padding: 14px;
    color: #000000;
    vertical-align: middle;
}

.table-genz tbody tr {
    border-bottom: 1px solid #e5e7eb;
    transition: 0.2s;
}

.table-genz tbody tr:hover {
    background: rgba(251,146,60,0.1);
}

/* Badge status */
.badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    color: white;
}

/* Status colors */
.badge-pending   { background: #f59e0b; } /* orange */
.badge-dikirim   { background: #3b82f6; } /* blue */
.badge-selesai   { background: #10b981; } /* green */
.badge-gagal     { background: #ef4444; } /* red */
.badge-default   { background: #6b7280; } /* abu-abu */

/* Button */
.btn-status {
    background: linear-gradient(135deg, #f97316, #fb923c);
    padding: 6px 12px;
    color: white;
    border-radius: 8px;
    font-size: 12px;
    text-decoration: none;
    transition: 0.3s;
    display: inline-block;
    cursor: pointer;
    border: none;
}

.btn-status:hover {
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(251,146,60,0.7);
}

/* Empty message */
.empty {
    text-align: center;
    padding: 30px;
    color: #9ca3af;
    font-weight: bold;
}
</style>

<div class="container-genz">

    <div class="header-genz">
        <h2>🚚 Data Pengiriman</h2>
    </div>

    <table class="table-genz">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                // Dummy data sementara jika belum ada tabel
                $pengiriman = $pengiriman ?? collect([
                    (object)[
                        'id' => 1,
                        'nama' => 'Zanza',
                        'alamat' => 'Jl. Merpati No.10',
                        'metode' => 'JNE',
                        'status' => 'pending'
                    ],
                    (object)[
                        'id' => 2,
                        'nama' => 'Budi',
                        'alamat' => 'Jl. Kenanga No.5',
                        'metode' => 'GO-SEND',
                        'status' => 'dikirim'
                    ],
                ]);
            @endphp

            @forelse($pengiriman as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->alamat }}</td>
                <td>{{ $p->metode }}</td>
                <td>
                    @php
                        $statusClass = match(strtolower($p->status)) {
                            'pending'   => 'badge-pending',
                            'dikirim'   => 'badge-dikirim',
                            'selesai'   => 'badge-selesai',
                            'gagal'     => 'badge-gagal',
                            default     => 'badge-default'
                        };
                    @endphp
                    <span class="badge {{ $statusClass }}">{{ ucfirst($p->status) }}</span>
                </td>
                <td>
                    @if(strtolower($p->status) == 'pending')
                    <form action="#" method="POST" style="display:inline;">
                        {{-- nanti diganti route pengiriman update --}}
                        <button class="btn-status" onclick="return confirm('Ubah status menjadi Dikirim?')">🚚 Kirim</button>
                    </form>
                    @elseif(strtolower($p->status) == 'dikirim')
                    <form action="#" method="POST" style="display:inline;">
                        {{-- nanti diganti route pengiriman update --}}
                        <button class="btn-status" onclick="return confirm('Ubah status menjadi Selesai?')">✔ Selesai</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="empty">😢 Belum ada pengiriman</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection