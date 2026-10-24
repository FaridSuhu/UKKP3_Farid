<?php
/**
 * Model MakananMinuman
 * Menangani CRUD data makanan dan minuman
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakananMinuman extends Model
{
    use HasFactory;

    protected $table = 'makanan_minuman';
    protected $fillable = ['nama', 'kategori', 'harga', 'stok'];
}
