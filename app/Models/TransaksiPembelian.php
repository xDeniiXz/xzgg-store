<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPembelian extends Model
{
    use HasFactory;

    protected $table = 'transaksi_pembelian';
    protected $primaryKey = 'pembelian_id';

    protected $fillable = [
        'produk_id',
        'user_id',
        'nama_supplier',
        'kontak_supplier',
        'jumlah',
        'harga_beli',
        'tanggal',
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'harga_beli' => 'integer',
        'tanggal' => 'date',
    ];

    /**
     * Relasi ke produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }

    /**
     * Relasi ke user (yang input transaksi)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Accessor untuk total pembelian
     */
    public function getTotalPembelianAttribute()
    {
        return $this->harga_beli * $this->jumlah;
    }

    /**
     * Scope untuk filter berdasarkan tanggal
     */
    public function scopeFilterTanggal($query, $dari, $sampai)
    {
        return $query->whereBetween('tanggal', [$dari, $sampai]);
    }

    /**
     * Scope untuk filter berdasarkan supplier
     */
    public function scopeBySupplier($query, $namaSupplier)
    {
        return $query->where('nama_supplier', 'like', "%{$namaSupplier}%");
    }
}
