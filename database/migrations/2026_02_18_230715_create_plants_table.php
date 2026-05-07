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
       Schema::create('plants', function (Blueprint $table) {
    $table->id();
    $table->string('nama_tanaman');
    $table->string('nama_latin');
    $table->string('kategori'); // Hipertensi / Asam Urat
    $table->text('manfaat');
    $table->text('cara_olah');
    $table->integer('stok')->default(0);
    $table->integer('min_stok')->default(10); // Batas stok menipis
    $table->string('slug')->unique();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};
