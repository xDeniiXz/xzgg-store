<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksi_penjualan', function (Blueprint $table) {
            $table->bigIncrements('transaksi_id');

            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('diskon_id')->nullable();

            $table->integer('jumlah');
            $table->integer('harga_satuan');

            // disimpan untuk histori (snapshot)
            $table->enum('jenis_diskon', ['persen', 'nominal'])->nullable();
            $table->integer('nilai_diskon')->nullable();

            $table->integer('total');
            $table->date('tanggal');

            $table->enum('status', ['selesai', 'dibatalkan'])->default('selesai');

            $table->timestamps();

            // ===== FOREIGN KEY =====
            $table->foreign('produk_id')
                ->references('produk_id')->on('produk')
                ->onDelete('restrict');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('restrict');

            $table->foreign('diskon_id')
                ->references('diskon_id')->on('diskon')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_penjualan');
    }
};
