<?php
/**
 * Migration: Menambahkan kolom role dan no_telp ke tabel users
 * Role: admin, petugas, customer
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'petugas', 'customer'])->default('customer')->after('password');
            $table->string('no_telp', 20)->nullable()->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'no_telp']);
        });
    }
};