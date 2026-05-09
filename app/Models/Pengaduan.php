<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'judul',
        'isi_pengaduan',
        'lokasi',
        'status',
        'catatan_rt',
        'diverifikasi_oleh',
        'tanggal_verifikasi',
    ];

    protected $casts = [
        'tanggal_verifikasi' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriPengaduan::class, 'kategori_id');
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }

    public function buktiList()
    {
        return $this->hasMany(BuktiPengaduan::class, 'pengaduan_id');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'dikirim'  => 'badge-dikirim',
            'diproses' => 'badge-diproses',
            'selesai'  => 'badge-selesai',
            'ditolak'  => 'badge-ditolak',
            default    => 'badge-dikirim',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'dikirim'  => 'Dikirim',
            'diproses' => 'Diproses',
            'selesai'  => 'Selesai',
            'ditolak'  => 'Ditolak',
            default    => 'Dikirim',
        };
    }
}
