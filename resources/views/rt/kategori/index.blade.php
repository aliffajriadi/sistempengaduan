@extends('layouts.app')
@section('title', 'Kelola Kategori')

@section('content')
<div class="page-header">
    <div class="breadcrumb"><a href="{{ route('rt.dashboard') }}">Dashboard</a> <i class="fas fa-chevron-right" style="font-size:.7rem;"></i> <span>Kategori Pengaduan</span></div>
    <div style="display: flex; justify-content: space-between; align-items: flex-end; gap: 1rem;">
        <div>
            <h1 class="page-title">Kategori Pengaduan 🏷️</h1>
            <p class="page-subtitle">Kelola kategori jenis pengaduan masyarakat.</p>
        </div>
        <a href="{{ route('rt.kategori.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> <span class="desktop-only">Tambah Kategori</span></a>
    </div>
</div>

<div class="card">
    @if($kategoriList->isEmpty())
        <div style="text-align:center; padding:4rem 0; color:var(--text-muted);">
            <i class="fas fa-tags" style="font-size:3rem; opacity:.1; display:block; margin-bottom:1rem;"></i>
            <p style="font-weight: 500; margin-bottom: 1.5rem;">Belum ada kategori yang ditambahkan.</p>
            <a href="{{ route('rt.kategori.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Pertama</a>
        </div>
    @else
        {{-- Desktop View --}}
        <div class="desktop-table">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Laporan</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategoriList as $i => $k)
                        <tr>
                            <td style="color: var(--text-muted); font-weight: 600;">{{ $kategoriList->firstItem() + $i }}</td>
                            <td style="font-weight: 800; color: var(--text); font-size: 0.95rem;">{{ $k->nama_kategori }}</td>
                            <td style="font-size: 0.85rem; color: var(--text-muted);">{{ $k->deskripsi ? Str::limit($k->deskripsi, 80) : '—' }}</td>
                            <td>
                                <span style="background: var(--primary-light); color: var(--primary); padding: 0.25rem 0.6rem; border-radius: 999px; font-size: 0.75rem; font-weight: 800;">
                                    {{ $k->pengaduan_list_count }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                    <a href="{{ route('rt.kategori.edit', $k) }}" class="btn btn-sm btn-outline"><i class="fas fa-edit"></i> Edit</a>
                                    <form method="POST" action="{{ route('rt.kategori.destroy', $k) }}" onsubmit="return confirm('Hapus kategori ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" style="background: transparent; color: var(--danger); border: 1px solid #fee2e2;"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Mobile View --}}
        <div class="mobile-list">
            @foreach($kategoriList as $k)
            <div style="background: var(--bg); border: 1px solid var(--border); border-radius: var(--radius); padding: 1.25rem;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                    <div>
                        <div style="font-weight: 800; color: var(--text); font-size: 1.1rem;">{{ $k->nama_kategori }}</div>
                        <div style="font-size: 0.75rem; color: var(--primary); font-weight: 700; margin-top: 0.15rem;">{{ $k->pengaduan_list_count }} Laporan</div>
                    </div>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('rt.kategori.edit', $k) }}" class="btn btn-sm btn-outline" style="width: 32px; height: 32px; padding: 0; justify-content: center;"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{ route('rt.kategori.destroy', $k) }}" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline" style="width: 32px; height: 32px; padding: 0; justify-content: center; color: var(--danger); border-color: #fee2e2;"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
                @if($k->deskripsi)
                <div style="font-size: 0.85rem; color: var(--text-muted); line-height: 1.5; border-top: 1px solid var(--border); padding-top: 0.75rem; margin-top: 0.5rem;">
                    {{ $k->deskripsi }}
                </div>
                @endif
            </div>
            @endforeach
        </div>

        @if($kategoriList->hasPages())
        <div class="pagination" style="margin-top: 1.5rem;">
            @if($kategoriList->onFirstPage())
                <span class="btn btn-outline" style="opacity: 0.5; cursor: not-allowed;"><i class="fas fa-chevron-left"></i></span>
            @else
                <a href="{{ $kategoriList->previousPageUrl() }}" class="btn btn-outline"><i class="fas fa-chevron-left"></i></a>
            @endif
            <span style="font-weight: 700; color: var(--text-muted); padding: 0 1rem; font-size: 0.875rem;">{{ $kategoriList->currentPage() }} / {{ $kategoriList->lastPage() }}</span>
            @if($kategoriList->hasMorePages())
                <a href="{{ $kategoriList->nextPageUrl() }}" class="btn btn-outline"><i class="fas fa-chevron-right"></i></a>
            @else
                <span class="btn btn-outline" style="opacity: 0.5; cursor: not-allowed;"><i class="fas fa-chevron-right"></i></span>
            @endif
        </div>
        @endif
    @endif
</div>
@endsection
