<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    use HasFactory;

    protected $table = 'diskon';
    protected $primaryKey = 'diskon_id';

    protected $fillable = [
        'nama_diskon',
        'jenis_diskon',
        'nilai',
        'kuota',
        'status',
    ];

    protected $casts = [
        'nilai' => 'integer',
        'kuota' => 'integer',
    ];

    /**
     * Relasi ke transaksi penjualan
     */
    public function transaksiPenjualan()
    {
        return $this->hasMany(TransaksiPenjualan::class, 'diskon_id', 'diskon_id');
    }

    /**
     * Scope untuk diskon aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope untuk diskon yang masih ada kuota
     */
    public function scopeAdaKuota($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('kuota')
                ->orWhere('kuota', '>', 0);
        });
    }
}
