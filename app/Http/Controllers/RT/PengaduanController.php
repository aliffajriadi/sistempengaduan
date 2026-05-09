<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with('user', 'kategori');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', '%' . $request->search . '%'));
            });
        }

        $pengaduanList = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('rt.pengaduan.index', compact('pengaduanList'));
    }

    public function show(Pengaduan $pengaduan)
    {
        $pengaduan->load('user', 'kategori', 'buktiList', 'verifikator');
        return view('rt.pengaduan.show', compact('pengaduan'));
    }

    public function verifikasi(Request $request, Pengaduan $pengaduan)
    {
        $validated = $request->validate([
            'status'      => 'required|in:diproses,selesai,ditolak',
            'catatan_rt'  => 'nullable|string|max:1000',
        ], [
            'status.required' => 'Status wajib dipilih.',
            'status.in'       => 'Status tidak valid.',
        ]);

        $pengaduan->update([
            'status'             => $validated['status'],
            'catatan_rt'         => $validated['catatan_rt'] ?? null,
            'diverifikasi_oleh'  => auth()->id(),
            'tanggal_verifikasi' => now(),
        ]);

        return redirect()->route('rt.pengaduan.show', $pengaduan)
            ->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}
