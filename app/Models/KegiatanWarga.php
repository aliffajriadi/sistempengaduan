<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KegiatanWarga extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_warga';

    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal_kegiatan',
        'lokasi',
        'dibuat_oleh',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
