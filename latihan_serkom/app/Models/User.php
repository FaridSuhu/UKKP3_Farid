<?php
/**
 * Model User
 * Menangani data pengguna dengan 3 role: admin, petugas, customer
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Pelayanan;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_telp',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Helper: cek role user
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPetugas(): bool
    {
        return $this->role === 'petugas';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    /**
     * Relasi: User punya banyak pengaduan
     */
    public function pelayanan()
    {
        return $this->hasMany(Pelayanan::class);
    }
}