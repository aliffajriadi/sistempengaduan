@extends('layouts.app')
@section('title', 'Detail Pengaduan')

@section('content')
<div class="page-header">
    <div class="breadcrumb">
        <a href="{{ route('rt.dashboard') }}">Dashboard</a>
        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
        <a href="{{ route('rt.pengaduan.index') }}">Pengaduan</a>
        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
        <span>Detail</span>
    </div>
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <h1 class="page-title" style="margin: 0;">Detail Pengaduan 📋</h1>
        <span class="badge badge-{{ $pengaduan->status }}" style="font-size: 0.9rem; padding: 0.5rem 1rem;">{{ $pengaduan->status_label }}</span>
    </div>
</div>

<div class="grid-responsive">
    {{-- Left Side: Main Info --}}
    <div>
        <div class="card">
            <h2 style="font-size: 1.25rem; font-weight: 800; margin-bottom: 1.5rem; color: var(--text); line-height: 1.4;">{{ $pengaduan->judul }}</h2>

            <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-bottom: 1.5rem;">
                <div style="background: var(--bg-muted); border-radius: 8px; padding: 0.5rem 0.85rem; font-size: 0.8rem; border: 1px solid var(--border);">
                    <span style="color: var(--text-muted); font-weight: 600;">Pelapor:</span>
                    <strong style="margin-left: 0.4rem; color: var(--primary);">{{ $pengaduan->user->name }}</strong>
                </div>
                <div style="background: var(--bg-muted); border-radius: 8px; padding: 0.5rem 0.85rem; font-size: 0.8rem; border: 1px solid var(--border);">
                    <span style="color: var(--text-muted); font-weight: 600;">Kategori:</span>
                    <strong style="margin-left: 0.4rem; color: var(--text);">{{ $pengaduan->kategori->nama_kategori ?? 'Umum' }}</strong>
                </div>
                @if($pengaduan->lokasi)
                <div style="background: var(--bg-muted); border-radius: 8px; padding: 0.5rem 0.85rem; font-size: 0.8rem; border: 1px solid var(--border);">
                    <i class="fas fa-map-marker-alt" style="color: var(--danger); margin-right: 0.4rem;"></i>
                    <span style="font-weight: 600;">{{ $pengaduan->lokasi }}</span>
                </div>
                @endif
                <div style="background: var(--bg-muted); border-radius: 8px; padding: 0.5rem 0.85rem; font-size: 0.8rem; border: 1px solid var(--border);">
                    <i class="fas fa-calendar" style="color: var(--text-muted); margin-right: 0.4rem;"></i>
                    <span style="font-weight: 600;">{{ $pengaduan->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>

            <div style="background: var(--bg); border-radius: var(--radius-sm); padding: 1.5rem; line-height: 1.8; font-size: 1rem; color: var(--text); border: 1px solid var(--border);">
                {{ $pengaduan->isi_pengaduan }}
            </div>
        </div>

        {{-- Bukti --}}
        @if($pengaduan->buktiList->isNotEmpty())
        <div class="card" style="margin-top: 1.5rem;">
            <h3 class="card-title" style="margin-bottom: 1.25rem;"><i class="fas fa-paperclip" style="color: var(--primary); margin-right: 0.6rem;"></i>Bukti Pendukung ({{ $pengaduan->buktiList->count() }})</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 1rem;">
                @foreach($pengaduan->buktiList as $bukti)
                    @if($bukti->isImage())
                        <a href="{{ $bukti->file_url }}" target="_blank" style="display: block; aspect-ratio: 1; border-radius: 12px; overflow: hidden; border: 2px solid var(--border); transition: all var(--transition);" onmouseover="this.style.borderColor='var(--primary)'; this.style.transform='scale(1.02)'" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='none'">
                            <img src="{{ $bukti->file_url }}" alt="Bukti" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                    @else
                        <a href="{{ $bukti->file_url }}" target="_blank" class="btn btn-outline" style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.75rem; height: 140px; text-align: center;">
                            <i class="fas fa-file-alt" style="font-size: 2rem; color: var(--primary);"></i>
                            <span style="font-size: 0.75rem; font-weight: 700;">Lihat Dokumen</span>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
        @endif
    </div>

    {{-- Right Side: Verifikasi --}}
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        {{-- Form Verifikasi --}}
        <div class="card" style="border-top: 4px solid var(--primary);">
            <h3 class="card-title" style="margin-bottom: 1.5rem;"><i class="fas fa-gavel" style="color: var(--primary); margin-right: 0.6rem;"></i>Tindak Lanjut RT</h3>

            <form method="POST" action="{{ route('rt.pengaduan.verifikasi', $pengaduan) }}">
                @csrf

                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label class="form-label" style="display: block; font-weight: 700; margin-bottom: 0.5rem; font-size: 0.875rem;">Status Keputusan <span style="color: var(--danger);">*</span></label>
                    <select name="status" class="form-control" required>
                        <option value="">— Pilih Status —</option>
                        <option value="diproses" {{ old('status', $pengaduan->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai"  {{ old('status', $pengaduan->status) == 'selesai' ? 'selected' : '' }}>Selesai / Selesai Ditangani</option>
                        <option value="ditolak"  {{ old('status', $pengaduan->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label class="form-label" style="display: block; font-weight: 700; margin-bottom: 0.5rem; font-size: 0.875rem;">Catatan / Tanggapan</label>
                    <textarea name="catatan_rt" class="form-control" rows="5" placeholder="Berikan instruksi atau alasan penolakan/selesai kepada pelapor...">{{ old('catatan_rt', $pengaduan->catatan_rt) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 0.875rem;">
                    <i class="fas fa-save"></i> Simpan Verifikasi
                </button>
            </form>
        </div>

        @if($pengaduan->verifikator)
        <div class="card" style="background: var(--bg-muted);">
            <div style="font-size: 0.8125rem; color: var(--text-muted); font-weight: 600;">
                <i class="fas fa-info-circle"></i> Verifikasi terakhir oleh:
                <div style="color: var(--text); font-size: 0.9rem; margin-top: 0.25rem;">{{ $pengaduan->verifikator->name }}</div>
                <div style="font-size: 0.75rem;">{{ $pengaduan->tanggal_verifikasi?->format('d M Y, H:i') }}</div>
            </div>
        </div>
        @endif

        <a href="{{ route('rt.pengaduan.index') }}" class="btn btn-outline" style="width: 100%; justify-content: center; padding: 0.875rem;">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>
</div>
@endsection
