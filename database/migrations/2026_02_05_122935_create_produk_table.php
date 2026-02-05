<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('produk_id');

            $table->unsignedBigInteger('kategori_id');

            $table->string('nama_produk', 100);
            $table->integer('harga');
            $table->integer('stok')->default(0);

            $table->timestamps();

            $table->foreign('kategori_id')
                ->references('kategori_id')
                ->on('kategori')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
