<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $guarded = [];
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
