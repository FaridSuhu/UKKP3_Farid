<?php
/**
 * Class DashboardController
 * Menampilkan dashboard berbeda untuk tiap role
 */
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\MakananMinuman;
use App\Models\Pelayanan;
use App\Models\User;

class DashboardController extends Controller
{
    public function admin()
    {
        $stats = [
            'total_user' => User::count(),
            'total_barang' => Barang::count(),
            'total_menu' => MakananMinuman::count(),
            'total_pengaduan' => Pelayanan::count(),
        ];
        return view('dashboard.admin', compact('stats'));
    }

    public function petugas()
    {
        $stats = [
            'total_customer' => User::where('role', 'customer')->count(),
            'total_barang' => Barang::count(),
            'total_menu' => MakananMinuman::count(),
            'total_pengaduan' => Pelayanan::count(),
        ];
        return view('dashboard.petugas', compact('stats'));
    }

    public function customer()
    {
        $stats = [
            'pengaduan_saya' => Pelayanan::where('user_id', auth()->id())->count(),
            'pending' => Pelayanan::where('user_id', auth()->id())->where('status', 'pending')->count(),
            'selesai' => Pelayanan::where('user_id', auth()->id())->where('status', 'selesai')->count(),
        ];
        return view('dashboard.customer', compact('stats'));
    }
}