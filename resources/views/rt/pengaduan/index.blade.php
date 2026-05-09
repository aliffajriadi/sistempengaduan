@extends('layouts.app')
@section('title', 'Kelola Pengaduan')

@section('content')
<div class="page-header">
    <div class="breadcrumb"><a href="{{ route('rt.dashboard') }}">Dashboard</a> <i class="fas fa-chevron-right" style="font-size:.7rem;"></i> <span>Kelola Pengaduan</span></div>
    <h1 class="page-title">Kelola Pengaduan 📋</h1>
    <p class="page-subtitle">Verifikasi dan tindak lanjut pengaduan masyarakat.</p>
</div>

{{-- Filters --}}
<div class="card" style="margin-bottom:1.5rem;">
    <form method="GET" class="flex gap-3 items-center" style="flex-wrap:wrap;">
        <div style="flex:1;min-width:200px;">
            <input type="text" name="search" class="form-control" placeholder="Cari laporan atau pelapor..." value="{{ request('search') }}">
        </div>
        <div>
            <select name="status" class="form-control">
                <option value="">Semua Status</option>
                <option value="dikirim"  {{ request('status')=='dikirim'  ? 'selected':'' }}>Dikirim</option>
                <option value="diproses" {{ request('status')=='diproses' ? 'selected':'' }}>Diproses</option>
                <option value="selesai"  {{ request('status')=='selesai'  ? 'selected':'' }}>Selesai</option>
                <option value="ditolak"  {{ request('status')=='ditolak'  ? 'selected':'' }}>Ditolak</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
        @if(request()->hasAny(['search','status']))
            <a href="{{ route('rt.pengaduan.index') }}" class="btn btn-outline"><i class="fas fa-times"></i> Reset</a>
        @endif
    </form>
</div>

<div class="card">
    @if($pengaduanList->isEmpty())
        <div style="text-align:center; padding:3rem 0; color:var(--text-muted);">
            <i class="fas fa-inbox" style="font-size:2.5rem; opacity:.2; display:block; margin-bottom:1rem;"></i>
            <p style="font-weight: 500;">Tidak ada pengaduan ditemukan.</p>
        </div>
    @else
        {{-- Desktop View --}}
        <div class="desktop-table">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Pelapor</th>
                            <th>Pengaduan</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengaduanList as $i => $p)
                        <tr>
                            <td style="color: var(--text-muted); font-weight: 600;">{{ $pengaduanList->firstItem() + $i }}</td>
                            <td>
                                <div style="font-weight:700; font-size: 0.9rem; color: var(--text);">{{ $p->user->name }}</div>
                                <div style="font-size:0.75rem; color:var(--text-muted);">{{ $p->user->no_hp ?? 'No HP: —' }}</div>
                            </td>
                            <td>
                                <div style="font-weight:700; color: var(--text);">{{ Str::limit($p->judul, 45) }}</div>
                                @if($p->lokasi)
                                <div style="font-size:.75rem; color:var(--text-muted); margin-top:.2rem;"><i class="fas fa-map-marker-alt"></i> {{ Str::limit($p->lokasi, 35) }}</div>
                                @endif
                            </td>
                            <td><span class="badge badge-outline" style="background: var(--bg); border: 1px solid var(--border);">{{ $p->kategori->nama_kategori ?? '—' }}</span></td>
                            <td>
                                <div style="font-weight: 600; font-size: 0.85rem;">{{ $p->created_at->format('d/m/Y') }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $p->created_at->format('H:i') }}</div>
                            </td>
                            <td><span class="badge badge-{{ $p->status }}">{{ $p->status_label }}</span></td>
                            <td style="text-align: right;">
                                <a href="{{ route('rt.pengaduan.show', $p) }}" class="btn btn-sm btn-primary">Detail</a>
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
            <a href="{{ route('rt.pengaduan.show', $p) }}" style="display: block; background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 1.25rem; text-decoration: none; color: inherit; transition: all var(--transition);" onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='var(--border)'">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                    <div style="display: flex; align-items: center; gap: 0.6rem;">
                        <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800;">
                            {{ strtoupper(substr($p->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <div style="font-weight: 800; font-size: 0.875rem; color: var(--text);">{{ $p->user->name }}</div>
                            <div style="font-size: 0.7rem; color: var(--text-muted);">{{ $p->created_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>
                    <span class="badge badge-{{ $p->status }}" style="font-size: 0.65rem;">{{ $p->status_label }}</span>
                </div>
                <div style="font-weight: 800; color: var(--text); font-size: 1rem; margin-bottom: 0.4rem; line-height: 1.4;">{{ Str::limit($p->judul, 70) }}</div>
                <div style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600; display: flex; align-items: center; gap: 0.4rem;">
                    <i class="fas fa-tag"></i> {{ $p->kategori->nama_kategori ?? 'Umum' }}
                    @if($p->lokasi)
                    <span style="opacity: 0.5;">•</span>
                    <i class="fas fa-map-marker-alt" style="color: var(--danger);"></i> {{ Str::limit($p->lokasi, 25) }}
                    @endif
                </div>
            </a>
            @endforeach
        </div>

        @if($pengaduanList->hasPages())
        <div class="pagination" style="margin-top: 1.5rem;">
            @if($pengaduanList->onFirstPage())
                <span class="btn btn-outline" style="opacity: 0.5; cursor: not-allowed; padding: 0.5rem 0.8rem;"><i class="fas fa-chevron-left"></i></span>
            @else
                <a href="{{ $pengaduanList->previousPageUrl() }}" class="btn btn-outline" style="padding: 0.5rem 0.8rem;"><i class="fas fa-chevron-left"></i></a>
            @endif

            <span style="font-weight: 700; font-size: 0.875rem; color: var(--text-muted); padding: 0 1rem;">
                Hal {{ $pengaduanList->currentPage() }} dari {{ $pengaduanList->lastPage() }}
            </span>

            @if($pengaduanList->hasMorePages())
                <a href="{{ $pengaduanList->nextPageUrl() }}" class="btn btn-outline" style="padding: 0.5rem 0.8rem;"><i class="fas fa-chevron-right"></i></a>
            @else
                <span class="btn btn-outline" style="opacity: 0.5; cursor: not-allowed; padding: 0.5rem 0.8rem;"><i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
        @endif
    @endif
</div>
@endsection
