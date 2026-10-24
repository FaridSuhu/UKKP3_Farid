<?php
/**
 * Class MakananMinumanController
 * CRUD Makanan & Minuman (Admin)
 */
namespace App\Http\Controllers;

use App\Models\MakananMinuman;
use Illuminate\Http\Request;

class MakananMinumanController extends Controller
{
    public function index()
    {
        $items = MakananMinuman::latest()->paginate(10);
        return view('makanan_minuman.index', compact('items'));
    }

    public function create()
    {
        return view('makanan_minuman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:makanan,minuman',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        MakananMinuman::create($validated);
        return redirect()->route('makanan-minuman.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(MakananMinuman $makanan_minuman)
    {
        return view('makanan_minuman.edit', ['item' => $makanan_minuman]);
    }

    public function update(Request $request, MakananMinuman $makanan_minuman)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:makanan,minuman',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $makanan_minuman->update($validated);
        return redirect()->route('makanan-minuman.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(MakananMinuman $makanan_minuman)
    {
        $makanan_minuman->delete();
        return redirect()->route('makanan-minuman.index')->with('success', 'Data berhasil dihapus.');
    }
}
