<?php
/**
 * Class UserController
 * CRUD User: Admin bisa kelola semua, Petugas hanya lihat & kelola Customer
 */
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user sesuai role yang login
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            // Admin: lihat semua user
            $users = User::latest()->get();
        } elseif ($user->isPetugas()) {
            // Petugas: hanya lihat petugas & customer
            $users = User::whereIn('role', ['petugas', 'customer'])->latest()->get();
        } else {
            abort(403);
        }

        return view('users.index', compact('users'));
    }

    /**
     * Form tambah user
     */
    public function create()
    {
        $user = auth()->user();
        // Admin bebas, Petugas hanya boleh tambah customer
        $allowedRoles = $user->isAdmin()
            ? ['admin', 'petugas', 'customer']
            : ['customer'];

        return view('users.create', compact('allowedRoles'));
    }

    /**
     * Simpan user baru
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_telp' => 'required|string|max:20',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,petugas,customer',
        ];

        $validated = $request->validate($rules);

        // Petugas hanya boleh membuat customer
        if ($user->isPetugas() && $validated['role'] !== 'customer') {
            abort(403, 'Petugas hanya boleh menambah customer.');
        }

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Form edit user
     */
    public function edit(User $user)
    {
        $current = auth()->user();

        if ($current->isPetugas() && $user->role !== 'customer') {
            abort(403, 'Petugas hanya boleh mengedit customer.');
        }

        $allowedRoles = $current->isAdmin()
            ? ['admin', 'petugas', 'customer']
            : ['customer'];

        return view('users.edit', compact('user', 'allowedRoles'));
    }

    /**
     * Update data user
     */
    public function update(Request $request, User $user)
    {
        $current = auth()->user();

        if ($current->isPetugas() && $user->role !== 'customer') {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_telp' => 'required|string|max:20',
            'role' => 'required|in:admin,petugas,customer',
        ]);

        if ($current->isPetugas() && $validated['role'] !== 'customer') {
            abort(403);
        }

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6|confirmed']);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil diupdate.');
    }

    /**
     * Hapus user
     */
    public function destroy(User $user)
    {
        $current = auth()->user();

        if ($current->isPetugas() && $user->role !== 'customer') {
            abort(403);
        }

        if ($user->id === $current->id) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}