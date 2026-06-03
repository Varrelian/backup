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
    Schema::create('registrants', function (Blueprint $table) {
    $table->id();

    // --- RELASI ---

    // Menghubungkan Siswa dengan Event yang dipilih.
    // onDelete('cascade') = Jika Event dihapus, data pendaftar ikut terhapus.
    $table->foreignId('event_id')->constrained('events')->onDelete('cascade');

    // --- DATA SISWA ---
    $table->string('name'); // Nama Lengkap
    $table->string('class_room'); // Kelas (Misal: XI RPL1)
    $table->string('email'); // Email Sekolah
    $table->string('phone'); // No WhatsApp

    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrants');
    }
};
