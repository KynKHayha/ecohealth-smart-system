<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tips', function (Blueprint $table) {
            // Kolom baru: gambar (upload file atau URL eksternal)
            $table->string('image')->nullable()->after('icon');
            // Jadikan icon nullable agar data lama tidak error
            $table->string('icon')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('tips', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->string('icon')->nullable(false)->change();
        });
    }
};
