@extends('layouts.app')
@section('title', 'Riwayat Laporan')

@section('content')
<div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end; gap: 1rem;">
    <div>
        <h1 style="font-size: 1.75rem; font-weight: 800; letter-spacing: -0.025em;">Riwayat Laporan Saya 📂</h1>
        <p style="color: var(--text-muted); font-weight: 500;">Daftar semua aspirasi dan keluhan yang telah Anda kirim.</p>
    </div>
    <a href="{{ route('masyarakat.pengaduan.create') }}" class="btn btn-primary" style="padding: 0.75rem 1.5rem;">
        <i class="fas fa-plus-circle"></i> Buat Laporan
    </a>
</div>

<div class="card">
    @if($pengaduanList->isEmpty())
        <div style="text-align:center; padding:5rem 0; color:var(--text-muted);">
            <i class="fas fa-clipboard-list" style="font-size:3.5rem; opacity:.1; display:block; margin-bottom:1.5rem;"></i>
            <h3 style="color: var(--text); margin-bottom: 0.5rem;">Belum ada laporan</h3>
            <p style="font-weight: 500; margin-bottom: 2rem;">Anda belum pernah mengirimkan laporan atau pengaduan.</p>
            <a href="{{ route('masyarakat.pengaduan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Mulai Lapor Sekarang
            </a>
        </div>
    @else
        {{-- Desktop View --}}
        <div class="desktop-table">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Judul Laporan</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th style="text-align: right;">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengaduanList as $i => $p)
                        <tr>
                            <td style="color: var(--text-muted); font-weight: 600;">{{ $pengaduanList->firstItem() + $i }}</td>
                            <td>
                                <div style="font-weight:700; font-size: 0.95rem; color: var(--text); margin-bottom: 0.25rem;">{{ Str::limit($p->judul, 60) }}</div>
                                @if($p->lokasi)
                                <div style="font-size:.8rem; color:var(--text-muted); display: flex; align-items: center; gap: 0.3rem;">
                                    <i class="fas fa-map-marker-alt" style="color: var(--danger); font-size: 0.75rem;"></i> {{ Str::limit($p->lokasi, 45) }}
                                </div>
                                @endif
                            </td>
                            <td>
                                <span style="font-size:.8rem; font-weight: 700; color: var(--text-muted); background: var(--bg); padding: 0.4rem 0.75rem; border-radius: 8px; border: 1px solid var(--border);">
                                    {{ $p->kategori->nama_kategori ?? 'Umum' }}
                                </span>
                            </td>
                            <td>
                                <div style="font-weight: 600;">{{ $p->created_at->format('d M Y') }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $p->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td><span class="badge badge-{{ $p->status }}">{{ $p->status_label }}</span></td>
                            <td style="text-align: right;">
                                <a href="{{ route('masyarakat.pengaduan.show', $p) }}" class="btn btn-outline" style="padding: 0.5rem 1rem;">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Mobile View --}}
        <div class="mobile-list">
            @foreach($pengaduanList as $p)
            <a href="{{ route('masyarakat.pengaduan.show', $p) }}" style="display: block; background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 1rem; text-decoration: none; transition: all var(--transition);" onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='var(--border)'">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                    <span class="badge badge-{{ $p->status }}" style="font-size: 0.7rem;">{{ $p->status_label }}</span>
                    <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 600;">{{ $p->created_at->format('d M Y') }}</span>
                </div>
                <div style="font-weight: 800; color: var(--text); font-size: 1rem; margin-bottom: 0.4rem; line-height: 1.4;">{{ Str::limit($p->judul, 80) }}</div>
                <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.8rem; color: var(--text-muted); font-weight: 500;">
                    <i class="fas fa-tag"></i> {{ $p->kategori->nama_kategori ?? 'Umum' }}
                    @if($p->lokasi)
                        <span style="opacity: 0.5;">•</span>
                        <span style="display: flex; align-items: center; gap: 0.25rem;">
                            <i class="fas fa-map-marker-alt" style="color: var(--danger);"></i> {{ Str::limit($p->lokasi, 25) }}
                        </span>
                    @endif
                </div>
            </a>
            @endforeach
        </div>

        @if($pengaduanList->hasPages())
        <div class="pagination" style="margin-top: 2rem;">
            @if($pengaduanList->onFirstPage())
                <span class="btn btn-outline" style="opacity: 0.5; cursor: not-allowed;"><i class="fas fa-chevron-left"></i></span>
            @else
                <a href="{{ $pengaduanList->previousPageUrl() }}" class="btn btn-outline"><i class="fas fa-chevron-left"></i></a>
            @endif

            @foreach($pengaduanList->getUrlRange(1, $pengaduanList->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="btn {{ $page == $pengaduanList->currentPage() ? 'btn-primary' : 'btn-outline' }}" style="min-width: 42px; justify-content: center;">{{ $page }}</a>
            @endforeach

            @if($pengaduanList->hasMorePages())
                <a href="{{ $pengaduanList->nextPageUrl() }}" class="btn btn-outline"><i class="fas fa-chevron-right"></i></a>
            @else
                <span class="btn btn-outline" style="opacity: 0.5; cursor: not-allowed;"><i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
        @endif
    @endif
</div>
@endsection
