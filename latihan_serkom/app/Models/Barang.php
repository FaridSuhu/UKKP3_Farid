<?php
/**
 * Model Barang
 * Menangani CRUD data barang dengan auto-generate kode barang
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $fillable = ['nama_barang', 'kode', 'stok', 'harga'];

    /**
     * Generate kode barang otomatis dengan format BRG-XXX
     * Contoh: BRG-001, BRG-002, BRG-010
     *
     * @return string
     */
    public static function generateKode(): string
    {
        // Ambil kode terakhir dari database (urut descending)
        $lastBarang = self::orderBy('id', 'desc')->first();

        if (!$lastBarang) {
            // Kalau belum ada data, mulai dari 001
            return 'BRG-001';
        }

        // Ambil angka dari kode terakhir (misal "BRG-005" → 5)
        $lastNumber = (int) substr($lastBarang->kode, 4);

        // Increment + padding 3 digit
        $newNumber = $lastNumber + 1;

        return 'BRG-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}