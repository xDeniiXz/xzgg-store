<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_penjualan';
    protected $primaryKey = 'transaksi_id';

    protected $fillable = [
        'produk_id',
        'user_id',
        'diskon_id',
        'jumlah',
        'harga_satuan',
        'jenis_diskon',
        'nilai_diskon',
        'total',
        'tanggal',
        'status',
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'harga_satuan' => 'integer',
        'nilai_diskon' => 'integer',
        'total' => 'integer',
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
     * Relasi ke user (kasir)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relasi ke diskon
     */
    public function diskon()
    {
        return $this->belongsTo(Diskon::class, 'diskon_id', 'diskon_id');
    }

    /**
     * Accessor untuk subtotal (sebelum diskon)
     */
    public function getSubtotalAttribute()
    {
        return $this->harga_satuan * $this->jumlah;
    }

    /**
     * Accessor untuk nilai diskon dalam rupiah
     */
    public function getNominalDiskonAttribute()
    {
        if (!$this->diskon_id) {
            return 0;
        }

        if ($this->jenis_diskon === 'persen') {
            return ($this->subtotal * $this->nilai_diskon) / 100;
        }

        return $this->nilai_diskon;
    }

    /**
     * Scope untuk transaksi selesai
     */
    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    /**
     * Scope untuk transaksi dibatalkan
     */
    public function scopeDibatalkan($query)
    {
        return $query->where('status', 'dibatalkan');
    }

    /**
     * Scope untuk filter berdasarkan tanggal
     */
    public function scopeFilterTanggal($query, $dari, $sampai)
    {
        return $query->whereBetween('tanggal', [$dari, $sampai]);
    }
}
