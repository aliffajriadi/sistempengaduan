<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriPengaduan extends Model
{
    use HasFactory;

    protected $table = 'kategori_pengaduan';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    public function pengaduanList()
    {
        return $this->hasMany(Pengaduan::class, 'kategori_id');
    }
}
