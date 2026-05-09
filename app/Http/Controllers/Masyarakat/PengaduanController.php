<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\BuktiPengaduan;
use App\Models\KategoriPengaduan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    public function index()
    {
        $pengaduanList = Pengaduan::with('kategori')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('masyarakat.pengaduan.index', compact('pengaduanList'));
    }

    public function create()
    {
        $kategoriList = KategoriPengaduan::orderBy('nama_kategori')->get();
        return view('masyarakat.pengaduan.create', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id'  => 'required|exists:kategori_pengaduan,id',
            'judul'        => 'required|string|max:150',
            'isi_pengaduan'=> 'required|string',
            'lokasi'       => 'nullable|string|max:255',
            'bukti'        => 'nullable|array|max:5',
            'bukti.*'      => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ], [
            'kategori_id.required'   => 'Kategori pengaduan wajib dipilih.',
            'judul.required'         => 'Judul pengaduan wajib diisi.',
            'isi_pengaduan.required' => 'Isi pengaduan wajib diisi.',
            'bukti.*.mimes'          => 'File harus berupa gambar (jpg, png) atau dokumen (pdf, doc, docx).',
            'bukti.*.max'            => 'Ukuran file maksimal 5MB.',
        ]);

        $pengaduan = Pengaduan::create([
            'user_id'      => auth()->id(),
            'kategori_id'  => $validated['kategori_id'],
            'judul'        => $validated['judul'],
            'isi_pengaduan'=> $validated['isi_pengaduan'],
            'lokasi'       => $validated['lokasi'] ?? null,
            'status'       => 'dikirim',
        ]);

        if ($request->hasFile('bukti')) {
            foreach ($request->file('bukti') as $file) {
                $path = $file->store('bukti_pengaduan', 'public');
                BuktiPengaduan::create([
                    'pengaduan_id' => $pengaduan->id,
                    'file_path'    => $path,
                    'file_type'    => $file->getMimeType(),
                ]);
            }
        }

        return redirect()->route('masyarakat.pengaduan.index')
            ->with('success', 'Pengaduan berhasil dikirim! Tim RT akan segera menindaklanjuti.');
    }

    public function show(Pengaduan $pengaduan)
    {
        if ($pengaduan->user_id !== auth()->id()) {
            abort(403);
        }
        $pengaduan->load('kategori', 'buktiList', 'verifikator');
        return view('masyarakat.pengaduan.show', compact('pengaduan'));
    }
}
