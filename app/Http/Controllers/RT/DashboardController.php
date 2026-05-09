<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengaduan;
use App\Models\Pengaduan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengaduan    = Pengaduan::count();
        $totalMasyarakat   = User::where('role', 'masyarakat')->count();
        $totalKategori     = KategoriPengaduan::count();
        $pengaduanDikirim  = Pengaduan::where('status', 'dikirim')->count();
        $pengaduanDiproses = Pengaduan::where('status', 'diproses')->count();
        $pengaduanSelesai  = Pengaduan::where('status', 'selesai')->count();
        $pengaduanDitolak  = Pengaduan::where('status', 'ditolak')->count();

        $pengaduanTerbaru = Pengaduan::with('user', 'kategori')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('rt.dashboard', compact(
            'totalPengaduan',
            'totalMasyarakat',
            'totalKategori',
            'pengaduanDikirim',
            'pengaduanDiproses',
            'pengaduanSelesai',
            'pengaduanDitolak',
            'pengaduanTerbaru'
        ));
    }
}
