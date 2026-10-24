<?php
/**
 * Migration: Membuat tabel pelayanan untuk pengaduan pelanggan
 * Menyimpan nama, email, no_telp, pengaduan, dan foto bukti
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelayanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('email');
            $table->string('no_telp', 20);
            $table->string('judul');
            $table->text('pengaduan');
            $table->string('foto')->nullable();
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelayanan');
    }
};
