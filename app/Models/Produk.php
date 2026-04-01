<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk'; // Pastikan ini nama tabel di database kamu
    protected $primaryKey = 'ProdukID'; // Sesuai dengan database kamu
    protected $fillable = ['NamaProduk', 'Harga', 'Stok', 'kategori', 'foto', 'Deskripsi'];
}