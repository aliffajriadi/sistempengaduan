<?php

namespace App\Http\Controllers\RT;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoriList = KategoriPengaduan::withCount('pengaduanList')
            ->orderBy('nama_kategori')
            ->paginate(15);

        return view('rt.kategori.index', compact('kategoriList'));
    }

    public function create()
    {
        return view('rt.kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_pengaduan,nama_kategori',
            'deskripsi'     => 'nullable|string',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori sudah ada.',
        ]);

        KategoriPengaduan::create($validated);

        return redirect()->route('rt.kategori.index')
            ->with('success', 'Kategori pengaduan berhasil ditambahkan.');
    }

    public function edit(KategoriPengaduan $kategori)
    {
        return view('rt.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, KategoriPengaduan $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_pengaduan,nama_kategori,' . $kategori->id,
            'deskripsi'     => 'nullable|string',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori sudah ada.',
        ]);

        $kategori->update($validated);

        return redirect()->route('rt.kategori.index')
            ->with('success', 'Kategori pengaduan berhasil diperbarui.');
    }

    public function destroy(KategoriPengaduan $kategori)
    {
        if ($kategori->pengaduanList()->count() > 0) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki pengaduan.');
        }

        $kategori->delete();

        return redirect()->route('rt.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
