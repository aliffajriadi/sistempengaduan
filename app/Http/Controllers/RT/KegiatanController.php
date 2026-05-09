<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use App\Models\KegiatanWarga;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = KegiatanWarga::with('pembuat');

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('lokasi', 'like', '%' . $request->search . '%');
        }

        $kegiatanList = $query->orderBy('tanggal_kegiatan', 'desc')->paginate(10);

        return view('rt.kegiatan.index', compact('kegiatanList'));
    }

    public function create()
    {
        return view('rt.kegiatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'            => 'required|string|max:200',
            'tanggal_kegiatan' => 'required|date',
            'lokasi'           => 'required|string|max:200',
            'deskripsi'        => 'required|string',
        ]);

        KegiatanWarga::create([
            'judul'            => $validated['judul'],
            'tanggal_kegiatan' => $validated['tanggal_kegiatan'],
            'lokasi'           => $validated['lokasi'],
            'deskripsi'        => $validated['deskripsi'],
            'dibuat_oleh'      => auth()->id(),
        ]);

        return redirect()->route('rt.kegiatan.index')
            ->with('success', 'Kegiatan warga berhasil ditambahkan.');
    }

    public function edit(KegiatanWarga $kegiatan)
    {
        return view('rt.kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, KegiatanWarga $kegiatan)
    {
        $validated = $request->validate([
            'judul'            => 'required|string|max:200',
            'tanggal_kegiatan' => 'required|date',
            'lokasi'           => 'required|string|max:200',
            'deskripsi'        => 'required|string',
        ]);

        $kegiatan->update($validated);

        return redirect()->route('rt.kegiatan.index')
            ->with('success', 'Kegiatan warga berhasil diperbarui.');
    }

    public function destroy(KegiatanWarga $kegiatan)
    {
        $kegiatan->delete();

        return redirect()->route('rt.kegiatan.index')
            ->with('success', 'Kegiatan warga berhasil dihapus.');
    }
}
