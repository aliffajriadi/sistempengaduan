@extends('layouts.app')
@section('title', 'Kelola Kegiatan')

@section('content')
<div class="page-header">
    <div class="breadcrumb"><a href="{{ route('rt.dashboard') }}">Dashboard</a> <i class="fas fa-chevron-right" style="font-size:.7rem;"></i> <span>Agenda Kegiatan</span></div>
    <div style="display: flex; justify-content: space-between; align-items: flex-end; gap: 1rem;">
        <div>
            <h1 class="page-title">Agenda Kegiatan 🗓️</h1>
            <p class="page-subtitle">Kelola jadwal kegiatan dan pengumuman untuk warga.</p>
        </div>
        <a href="{{ route('rt.kegiatan.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah Kegiatan</a>
    </div>
</div>

<div class="card">
    @if($kegiatanList->isEmpty())
        <div style="text-align:center; padding:4rem 0; color:var(--text-muted);">
            <i class="fas fa-calendar-alt" style="font-size:3rem; opacity:.1; display:block; margin-bottom:1rem;"></i>
            <p style="font-weight: 500; margin-bottom: 1.5rem;">Belum ada agenda kegiatan yang dibuat.</p>
            <a href="{{ route('rt.kegiatan.create') }}" class="btn btn-primary">Buat Agenda Pertama</a>
        </div>
    @else
        <div class="desktop-table">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Kegiatan</th>
                            <th>Waktu & Lokasi</th>
                            <th>Pembuat</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kegiatanList as $i => $k)
                        <tr>
                            <td style="color: var(--text-muted); font-weight: 600;">{{ $kegiatanList->firstItem() + $i }}</td>
                            <td>
                                <div style="font-weight: 800; color: var(--text); font-size: 0.95rem;">{{ $k->judul }}</div>
                                <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.25rem;">{{ Str::limit($k->deskripsi, 60) }}</div>
                            </td>
                            <td>
                                <div style="font-weight: 700; font-size: 0.85rem;"><i class="fas fa-calendar-day" style="color: var(--primary); margin-right: 0.4rem;"></i> {{ $k->tanggal_kegiatan->format('d M Y') }}</div>
                                <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.25rem;"><i class="fas fa-map-marker-alt" style="color: var(--danger); margin-right: 0.4rem;"></i> {{ $k->lokasi }}</div>
                            </td>
                            <td>
                                <div style="font-size: 0.8rem; font-weight: 600;">{{ $k->pembuat->name ?? 'System' }}</div>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                    <a href="{{ route('rt.kegiatan.edit', $k) }}" class="btn btn-sm btn-outline"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{ route('rt.kegiatan.destroy', $k) }}" onsubmit="return confirm('Hapus kegiatan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline" style="color: var(--danger); border-color: #fee2e2;"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mobile-list">
            @foreach($kegiatanList as $k)
            <div style="background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 1.25rem;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                    <div>
                        <div style="font-weight: 800; color: var(--text); font-size: 1.1rem; line-height: 1.3;">{{ $k->judul }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600; margin-top: 0.25rem;">
                            <i class="fas fa-calendar"></i> {{ $k->tanggal_kegiatan->format('d M Y') }}
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('rt.kegiatan.edit', $k) }}" class="btn btn-sm btn-outline" style="width: 32px; height: 32px; padding: 0; justify-content: center;"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{ route('rt.kegiatan.destroy', $k) }}" onsubmit="return confirm('Hapus kegiatan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline" style="width: 32px; height: 32px; padding: 0; justify-content: center; color: var(--danger); border-color: #fee2e2;"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
                <div style="font-size: 0.85rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.4rem; margin-top: 0.5rem; padding-top: 0.5rem; border-top: 1px solid var(--border);">
                    <i class="fas fa-map-marker-alt" style="color: var(--danger);"></i> {{ $k->lokasi }}
                </div>
            </div>
            @endforeach
        </div>

        @if($kegiatanList->hasPages())
        <div class="pagination" style="margin-top: 1.5rem;">
            @if($kegiatanList->onFirstPage())
                <span class="btn btn-outline" style="opacity: 0.5; cursor: not-allowed;"><i class="fas fa-chevron-left"></i></span>
            @else
                <a href="{{ $kegiatanList->previousPageUrl() }}" class="btn btn-outline"><i class="fas fa-chevron-left"></i></a>
            @endif
            <span style="font-weight: 700; color: var(--text-muted); padding: 0 1rem;">{{ $kegiatanList->currentPage() }} / {{ $kegiatanList->lastPage() }}</span>
            @if($kegiatanList->hasMorePages())
                <a href="{{ $kegiatanList->nextPageUrl() }}" class="btn btn-outline"><i class="fas fa-chevron-right"></i></a>
            @else
                <span class="btn btn-outline" style="opacity: 0.5; cursor: not-allowed;"><i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
        @endif
    @endif
</div>
@endsection
