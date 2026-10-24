<?php
/**
 * Seeder: Membuat akun default untuk Admin, Petugas, Customer
 */
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'no_telp' => '081111111111',
        ]);

        User::create([
            'name' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
            'no_telp' => '082222222222',
        ]);

        User::create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
            'no_telp' => '083333333333',
        ]);
    }
}