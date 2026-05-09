<?php

namespace Database\Seeders;

use App\Models\KategoriPengaduan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun RT default
        User::updateOrCreate(
            ['email' => 'rt@sispem.id'],
            [
                'name'     => 'Pengurus RT 01',
                'password' => Hash::make('password123'),
                'role'     => 'rt',
                'no_hp'    => '081200000001',
                'alamat'   => 'Jl. Mawar No. 1, RT 01',
            ]
        );

        // Kategori default
        $kategoriList = [
            ['nama_kategori' => 'Keamanan',       'deskripsi' => 'Pengaduan terkait keamanan lingkungan, pencurian, atau gangguan ketertiban.'],
            ['nama_kategori' => 'Kebersihan',      'deskripsi' => 'Pengaduan terkait sampah, kebersihan lingkungan, dan saluran air.'],
            ['nama_kategori' => 'Infrastruktur',   'deskripsi' => 'Pengaduan terkait jalan berlubang, lampu jalan, atau fasilitas umum rusak.'],
            ['nama_kategori' => 'Sosial',          'deskripsi' => 'Pengaduan terkait permasalahan sosial antar warga.'],
            ['nama_kategori' => 'Administrasi',    'deskripsi' => 'Pengaduan terkait pelayanan administrasi RT.'],
            ['nama_kategori' => 'Lain-lain',       'deskripsi' => 'Pengaduan di luar kategori yang tersedia.'],
        ];

        foreach ($kategoriList as $k) {
            KategoriPengaduan::updateOrCreate(
                ['nama_kategori' => $k['nama_kategori']],
                $k
            );
        }
    }
}
