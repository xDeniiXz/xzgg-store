<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transaksi_pembelian', function (Blueprint $table) {
            $table->id('pembelian_id');

            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('user_id');

            // DATA SUPPLIER LANGSUNG DI TRANSAKSI
            $table->string('nama_supplier', 100);
            $table->string('kontak_supplier', 50);

            $table->integer('jumlah');
            $table->integer('harga_beli');
            $table->date('tanggal');

            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('produk_id')
                ->references('produk_id')
                ->on('produk')
                ->cascadeOnDelete();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_pembelian');
    }
};
