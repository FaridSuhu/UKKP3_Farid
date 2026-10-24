<?php
/**
 * Class BarangController
 * CRUD Barang dengan auto-generate kode barang (Admin & Petugas)
 */
namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Tampilkan daftar barang
     */
    public function index()
    {
        $barang = Barang::latest()->paginate(10);
        return view('barang.index', compact('barang'));
    }

    /**
     * Form tambah barang
     * Kode barang di-generate otomatis (preview)
     */
    public function create()
    {
        // Generate preview kode berikutnya
        $kodeOtomatis = Barang::generateKode();
        return view('barang.create', compact('kodeOtomatis'));
    }

    /**
     * Simpan barang baru
     * Kode TIDAK diambil dari input user, tapi di-generate otomatis
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        // Auto-generate kode barang
        $validated['kode'] = Barang::generateKode();

        Barang::create($validated);
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan dengan kode ' . $validated['kode']);
    }

    /**
     * Form edit barang
     */
    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update barang
     * Kode barang TIDAK diubah (tetap)
     */
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        // Kode barang tidak ikut diupdate (biarkan tetap)
        $barang->update($validated);
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate.');
    }

    /**
     * Hapus barang
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
