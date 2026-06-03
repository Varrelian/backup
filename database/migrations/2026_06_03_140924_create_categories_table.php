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
Schema::create('categories', function (Blueprint $table) {
$table->id(); // ID Unik

// Kolom Nama Kategori (Contoh: 'Class Meeting')
$table->string('name');

// Kolom URL Cantik (Contoh: 'class-meeting')
// unique() = Tidak boleh ada URL yang kembar
$table->string('slug')->unique();

$table->timestamps(); // Waktu pembuatan
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
