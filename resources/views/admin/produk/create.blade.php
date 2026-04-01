<form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="NamaProduk" placeholder="Nama Barang" required>
    <input type="number" name="Harga" placeholder="Harga" required>
    <input type="number" name="Stok" placeholder="Jumlah Stok" required>
    <select name="kategori">
        <option value="Pakaian">Pakaian</option>
        <option value="Elektronik">Elektronik</option>
        <option value="Aksesoris">Aksesoris</option>
    </select>
    <input type="file" name="foto" required> <button type="submit">Simpan Produk</button>
</form>