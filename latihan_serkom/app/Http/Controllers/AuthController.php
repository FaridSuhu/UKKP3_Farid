<?php
/**
 * Class AuthController
 * Menangani proses Register (khusus customer), Login, dan Logout
 */
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login user dan deteksi role
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Redirect sesuai role
            return match ($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'petugas' => redirect()->route('petugas.dashboard'),
                'customer' => redirect()->route('customer.dashboard'),
                default => redirect('/'),
            };
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    /**
     * Menampilkan halaman register (hanya untuk customer)
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses register: hanya bisa membuat akun customer
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_telp' => 'required|string|max:20',
            'password' => 'required|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'customer'; // Paksa role customer

        User::create($validated);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
