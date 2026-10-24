<?php
/**
 * Model Pelayanan
 * Menangani data pengaduan/keluhan pelanggan beserta foto bukti
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    use HasFactory;

    protected $table = 'pelayanan';
    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'no_telp',
        'judul',
        'pengaduan',
        'foto',
        'status'
    ];

    /**
     * Relasi: Pelayanan milik satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
