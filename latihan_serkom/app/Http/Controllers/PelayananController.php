<?php
/**
 * Class PelayananController
 * Menangani form pengaduan pelanggan dengan upload foto bukti
 */
namespace App\Http\Controllers;

use App\Models\Pelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PelayananController extends Controller
{
    /**
     * Tampilkan daftar pengaduan
     * Customer: hanya melihat pengaduan sendiri
     * Admin: melihat semua
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isCustomer()) {
            $pelayanan = Pelayanan::where('user_id', $user->id)->latest()->paginate(10);
        } else {
            $pelayanan = Pelayanan::with('user')->latest()->paginate(10);
        }

        return view('pelayanan.index', compact('pelayanan'));
    }

    /**
     * Form buat pengaduan
     */
    public function create()
    {
        return view('pelayanan.create');
    }

    /**
     * Simpan pengaduan + upload foto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'no_telp' => 'required|string|max:20',
            'judul' => 'required|string|max:255',
            'pengaduan' => 'required|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload foto ke storage/app/public/pengaduan
        $fotoPath = $request->file('foto')->store('pengaduan', 'public');

        Pelayanan::create([
            'user_id' => auth()->id(),
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_telp' => $validated['no_telp'],
            'judul' => $validated['judul'],
            'pengaduan' => $validated['pengaduan'],
            'foto' => $fotoPath,
        ]);

        return redirect()->route('pelayanan.index')->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function show(Pelayanan $pelayanan)
    {
        // Customer hanya boleh lihat miliknya
        if (auth()->user()->isCustomer() && $pelayanan->user_id !== auth()->id()) {
            abort(403);
        }

        return view('pelayanan.show', compact('pelayanan'));
    }

    public function edit(Pelayanan $pelayanan)
    {
        if (auth()->user()->isCustomer() && $pelayanan->user_id !== auth()->id()) {
            abort(403);
        }
        return view('pelayanan.edit', compact('pelayanan'));
    }

    public function update(Request $request, Pelayanan $pelayanan)
    {
        if (auth()->user()->isCustomer() && $pelayanan->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'no_telp' => 'required|string|max:20',
            'judul' => 'required|string|max:255',
            'pengaduan' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'nullable|in:pending,proses,selesai',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($pelayanan->foto) {
                Storage::disk('public')->delete($pelayanan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pengaduan', 'public');
        }

        $pelayanan->update($validated);
        return redirect()->route('pelayanan.index')->with('success', 'Pengaduan berhasil diupdate.');
    }

    public function destroy(Pelayanan $pelayanan)
    {
        if (auth()->user()->isCustomer() && $pelayanan->user_id !== auth()->id()) {
            abort(403);
        }

        if ($pelayanan->foto) {
            Storage::disk('public')->delete($pelayanan->foto);
        }

        $pelayanan->delete();
        return redirect()->route('pelayanan.index')->with('success', 'Pengaduan berhasil dihapus.');
    }
}
