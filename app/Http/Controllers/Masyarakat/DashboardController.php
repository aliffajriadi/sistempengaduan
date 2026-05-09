<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\KegiatanWarga;
use App\Models\Pengaduan;

class DashboardController extends Controller
{
    public function index()
    {
        $kegiatanList = KegiatanWarga::with('pembuat')
            ->orderBy('tanggal_kegiatan', 'desc')
            ->take(6)
            ->get();

        $totalPengaduan      = Pengaduan::where('user_id', auth()->id())->count();
        $pengaduanDiproses   = Pengaduan::where('user_id', auth()->id())->where('status', 'diproses')->count();
        $pengaduanSelesai    = Pengaduan::where('user_id', auth()->id())->where('status', 'selesai')->count();

        $pengaduanTerbaru = Pengaduan::with('kategori')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('masyarakat.dashboard', compact(
            'kegiatanList',
            'totalPengaduan',
            'pengaduanDiproses',
            'pengaduanSelesai',
            'pengaduanTerbaru'
        ));
    }
}
