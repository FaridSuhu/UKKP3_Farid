<?php
/**
 * Seeder: Membuat data dummy barang dengan kode auto-generate
 */
namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['nama_barang' => 'Kertas HVS A4', 'stok' => 100, 'harga' => 45000],
            ['nama_barang' => 'Pulpen Standard', 'stok' => 200, 'harga' => 3000],
            ['nama_barang' => 'Spidol Whiteboard', 'stok' => 50, 'harga' => 12000],
            ['nama_barang' => 'Penghapus Papan', 'stok' => 30, 'harga' => 8000],
            ['nama_barang' => 'Buku Tulis 38 Lembar', 'stok' => 150, 'harga' => 5000],
        ];

        foreach ($items as $item) {
            $item['kode'] = Barang::generateKode();
            Barang::create($item);
        }
    }
}