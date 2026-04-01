@extends('admin.layouts.app')

@section('title', 'Manajemen Pesanan')
@section('page_title', 'Manajemen Pesanan')
@section('page_sub', 'Kelola semua pesanan pelanggan')

@section('styles')
<style>
.card { background:white; border-radius:12px; padding:20px; border:1px solid #eee; }

table { width:100%; border-collapse: collapse; font-size:13px; }
th { text-align:left; padding:10px; font-size:12px; color:#888; border-bottom:2px solid #eee; }
td { padding:12px 10px; border-bottom:1px solid #f5f5f5; }

.status {
    padding:4px 10px;
    border-radius:10px;
    font-size:12px;
    font-weight:600;
}

.status-pending { background:#fff3cd; color:#856404; }
.status-diproses { background:#cff4fc; color:#055160; }
.status-selesai { background:#d1e7dd; color:#0f5132; }
.status-batal { background:#f8d7da; color:#842029; }

.btn-update {
    padding:6px 10px;
    border:none;
    border-radius:8px;
    background:#FF6B35;
    color:white;
    cursor:pointer;
    font-size:12px;
}
</style>
@endsection

@section('content')

<div class="card">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Produk</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

        @forelse($pesanan as $p)
        @php
            $statusClass = match($p->status) {
                'pending' => 'status-pending',
                'diproses' => 'status-diproses',
                'selesai' => 'status-selesai',
                default => 'status-batal'
            };
        @endphp

        <tr>
            <td>#{{ $p->id }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->produk }}</td>
            <td>Rp {{ number_format($p->total,0,',','.') }}</td>

            <td>
                <span class="status {{ $statusClass }}">
                    {{ $p->status }}
                </span>
            </td>

            <td>
                <form method="POST" action="{{ route('admin.pesanan.update', $p->id) }}">
                    @csrf
                    @method('PUT')

                    <select name="status">
                        <option value="pending" {{ $p->status=='pending'?'selected':'' }}>Pending</option>
                        <option value="diproses" {{ $p->status=='diproses'?'selected':'' }}>Diproses</option>
                        <option value="selesai" {{ $p->status=='selesai'?'selected':'' }}>Selesai</option>
                        <option value="batal" {{ $p->status=='batal'?'selected':'' }}>Batal</option>
                    </select>

                    <button class="btn-update">Update</button>
                </form>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="6" style="text-align:center;color:#aaa;padding:30px">
                Belum ada pesanan
            </td>
        </tr>
        @endforelse

        </tbody>
    </table>
</div>

@endsection