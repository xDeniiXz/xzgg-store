<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('diskon', function (Blueprint $table) {
            $table->bigIncrements('diskon_id');

            $table->string('nama_diskon', 100);
            $table->enum('jenis_diskon', ['persen', 'nominal']);
            $table->integer('nilai');
            $table->integer('kuota')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diskon');
    }
};
