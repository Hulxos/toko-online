<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran'; // pakai nama tabel tepat
    protected $fillable = ['nama', 'metode', 'total', 'status'];
}
