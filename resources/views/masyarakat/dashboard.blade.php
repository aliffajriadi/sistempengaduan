@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 style="font-size: 1.75rem; font-weight: 800; letter-spacing: -0.025em;">Halo, {{ explode(' ', auth()->user()->name)[0] }}! 👋</h1>
    <p style="color: var(--text-muted); font-weight: 500;">Selamat datang kembali di Sistem Pengaduan Masyarakat.</p>
</div>

{{-- Stats --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-file-alt"></i></div>
        <div>
            <div class="stat-value">{{ $totalPengaduan }}</div>
            <div class="stat-label">Total Laporan</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon amber"><i class="fas fa-clock"></i></div>
        <div>
            <div class="stat-value">{{ $pengaduanDiproses }}</div>
            <div class="stat-label">Sedang Diproses</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
        <div>
            <div class="stat-value">{{ $pengaduanSelesai }}</div>
            <div class="stat-label">Selesai</div>
        </div>
    </div>
</div>

<div class="grid-2" style="gap:1.5rem; align-items: start;">
    {{-- Kegiatan Warga --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Agenda Lingkungan</h3>
        </div>

        @if($kegiatanList->isEmpty())
            <div style="text-align:center; padding:3rem 0; color:var(--text-muted);">
                <i class="fas fa-calendar-day" style="font-size:2.5rem; opacity:.2; display:block; margin-bottom:1rem;"></i>
                <p style="font-weight: 500;">Belum ada jadwal kegiatan terbaru.</p>
            </div>
        @else
            <div style="display:flex; flex-direction:column; gap:1rem;">
                @foreach($kegiatanList as $kegiatan)
                <div style="background:var(--bg); border-radius:var(--radius); padding:1.25rem; display:flex; gap:1.25rem; align-items:center; border: 1px solid var(--border);">
                    <div style="background: var(--primary); color: #fff; border-radius: 12px; padding: 0.5rem; text-align: center; min-width: 60px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);">
                        <div style="font-size: 0.7rem; font-weight: 700; text-transform: uppercase; opacity: 0.9;">{{ $kegiatan->tanggal_kegiatan ? $kegiatan->tanggal_kegiatan->format('M') : '—' }}</div>
                        <div style="font-size: 1.25rem; font-weight: 800; line-height: 1;">{{ $kegiatan->tanggal_kegiatan ? $kegiatan->tanggal_kegiatan->format('d') : '—' }}</div>
                    </div>
                    <div style="flex: 1;">
                        <div style="font-weight: 700; font-size: 1rem; margin-bottom: 0.25rem; color: var(--text);">{{ $kegiatan->judul }}</div>
                        <div style="font-size: 0.875rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.4rem;">
                            <i class="fas fa-map-marker-alt" style="color: var(--danger); font-size: 0.8rem;"></i> {{ $kegiatan->lokasi ?? 'Lokasi tidak ditentukan' }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Pengaduan Terbaru --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Riwayat Laporan</h3>
            <a href="{{ route('masyarakat.pengaduan.index') }}" style="font-size: 0.875rem; font-weight: 700;">Lihat Semua</a>
        </div>

        @if($pengaduanTerbaru->isEmpty())
            <div style="text-align:center; padding:3rem 0; color:var(--text-muted);">
                <i class="fas fa-folder-open" style="font-size:2.5rem; opacity:.2; display:block; margin-bottom:1rem;"></i>
                <p style="font-weight: 500; margin-bottom: 1.5rem;">Anda belum pernah mengirim laporan.</p>
                <a href="{{ route('masyarakat.pengaduan.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Buat Laporan Pertama
                </a>
            </div>
        @else
            <div style="display:flex; flex-direction:column; gap:0.75rem;">
                @foreach($pengaduanTerbaru as $p)
                <a href="{{ route('masyarakat.pengaduan.show', $p) }}" style="display:flex; align-items:center; justify-content:space-between; background:white; border: 1px solid var(--border); border-radius:var(--radius-sm); padding:1rem; transition: all var(--transition);" onmouseover="this.style.borderColor='var(--primary)'; this.style.transform='translateX(4px)'" onmouseout="this.style.borderColor='var(--border)'; this.style.transform='none'">
                    <div style="flex: 1;">
                        <div style="font-weight:700; font-size:0.9375rem; color: var(--text); margin-bottom: 0.25rem;">{{ Str::limit($p->judul, 40) }}</div>
                        <div style="font-size:0.8125rem; color:var(--text-muted); font-weight: 500;">
                            {{ $p->kategori->nama_kategori ?? 'Umum' }} • {{ $p->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <span class="badge badge-{{ $p->status }}">{{ $p->status_label }}</span>
                </a>
                @endforeach
            </div>
            <div style="margin-top: 1.5rem;">
                <a href="{{ route('masyarakat.pengaduan.create') }}" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 1rem;">
                    <i class="fas fa-plus-circle"></i> Buat Laporan Baru
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
