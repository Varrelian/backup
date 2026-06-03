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
    Schema::create('events', function (Blueprint $table) {
    $table->id();

    // --- RELASI (TALI PENGHUBUNG) ---

    // Menghubungkan Event dengan Kategori.
    // constrained() = Menjaga agar ID kategori BENAR-BENARADA.
    $table->foreignId('category_id')->constrained('categories');

    // --- DATA UTAMA ---
    $table->string('title'); // Judul Acara
    $table->text('description'); // Deskripsi (Panjang)
    $table->date('event_date'); // Tanggal Acara
    $table->string('location'); // Lokasi(Aula/Lapangan)

    // --- LOGIKA BISNIS ---
    $table->integer('quota'); // Sisa Kuota (Angka)

    // --- KEAMANAN DATA (ENUM) ---
    // Status hanya boleh: 'draft' (disimpan) atau'published' (tayang)
    $table->enum('status', ['draft', 'published'])->default('draft');

    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
