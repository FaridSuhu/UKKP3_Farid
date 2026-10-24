<?php
/**
 * Class ProfilController
 * Customer hanya bisa mengubah profil dirinya sendiri
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('profil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_telp' => 'required|string|max:20',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6|confirmed']);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);
        return redirect()->route('profil.edit')->with('success', 'Profil berhasil diupdate.');
    }
}