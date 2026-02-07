<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'produk_id';

    protected $fillable = [
        'kategori_id',
        'nama_produk',
        'harga',
        'stok',
    ];

    protected $casts = [
        'harga' => 'integer',
        'stok' => 'integer',
    ];

    /**
     * Relasi ke kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    /**
     * Relasi ke transaksi pembelian
     */
    public function transaksiPembelian()
    {
        return $this->hasMany(TransaksiPembelian::class, 'produk_id', 'produk_id');
    }

    /**
     * Relasi ke transaksi penjualan
     */
    public function transaksiPenjualan()
    {
        return $this->hasMany(TransaksiPenjualan::class, 'produk_id', 'produk_id');
    }

    /**
     * Scope untuk produk dengan stok rendah
     */
    public function scopeStokRendah($query, $batas = 10)
    {
        return $query->where('stok', '<=', $batas)->where('stok', '>', 0);
    }

    /**
     * Scope untuk produk yang tersedia (stok > 0)
     */
    public function scopeTersedia($query)
    {
        return $query->where('stok', '>', 0);
    }
}
