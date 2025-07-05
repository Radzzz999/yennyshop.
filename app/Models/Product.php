<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'sku',
        'nama_product',
        'kategori',
        'type',
        'harga',
        'deskripsi',
        'stok',
        'stok_in',
        'stok_out',
        'foto1',
        'foto2',
        'foto3',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'stok' => 'float',
        'harga' => 'integer',
    ];

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_barang', 'id');
    }

    public function scopeAktif($query)
    {
        return $query->where('is_active', 1);
    }
}