@extends('layouts.app')
@section('title', 'Dashboard RT')

@section('content')
<div style="margin-bottom: 2rem;">
    <h1 style="font-size: 1.75rem; font-weight: 800; letter-spacing: -0.025em;">Ringkasan RT 📊</h1>
    <p style="color: var(--text-muted); font-weight: 500;">Pantau aktivitas dan laporan warga secara real-time.</p>
</div>

{{-- Stats Grid --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon purple"><i class="fas fa-inbox"></i></div>
        <div>
            <div class="stat-value">{{ $totalPengaduan }}</div>
            <div class="stat-label">Total Laporan</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-users"></i></div>
        <div>
            <div class="stat-value">{{ $totalMasyarakat }}</div>
            <div class="stat-label">Warga Terdaftar</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon amber"><i class="fas fa-tags"></i></div>
        <div>
            <div class="stat-value">{{ $totalKategori }}</div>
            <div class="stat-label">Kategori</div>
        </div>
    </div>
    <div class="stat-card" style="border-color: var(--danger);">
        <div class="stat-icon red" style="background: #fef2f2; color: var(--danger);"><i class="fas fa-exclamation-triangle"></i></div>
        <div>
            <div class="stat-value" style="color: var(--danger);">{{ $pengaduanDikirim }}</div>
            <div class="stat-label">Laporan Baru</div>
        </div>
    </div>
</div>

{{-- Status Summary + Recent --}}
<div class="grid-2" style="gap:1.5rem; align-items: start;">
    {{-- Status distribution --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Status Laporan</h3>
        </div>

        @php
            $total = max($pengaduanDikirim + $pengaduanDiproses + $pengaduanSelesai + $pengaduanDitolak, 1);
            $items = [
                ['label'=>'Dikirim',   'val'=>$pengaduanDikirim,  'color'=>'#3b82f6', 'class'=>'badge-dikirim'],
                ['label'=>'Diproses',  'val'=>$pengaduanDiproses, 'color'=>'#f59e0b', 'class'=>'badge-diproses'],
                ['label'=>'Selesai',   'val'=>$pengaduanSelesai,  'color'=>'#10b981', 'class'=>'badge-selesai'],
                ['label'=>'Ditolak',   'val'=>$pengaduanDitolak,  'color'=>'#ef4444', 'class'=>'badge-ditolak'],
            ];
        @endphp

        <div style="display: flex; flex-direction: column; gap: 1.25rem;">
            @foreach($items as $item)
            <div>
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.5rem;">
                    <span class="badge {{ $item['class'] }}">{{ $item['label'] }}</span>
                    <span style="font-weight:800; font-size: 1rem;">{{ $item['val'] }}</span>
                </div>
                <div style="background:var(--bg); border-radius:999px; height:10px; overflow:hidden; border: 1px solid var(--border);">
                    <div style="background:{{ $item['color'] }}; height:100%; width:{{ round($item['val']/$total*100) }}%; border-radius:999px; transition:width 1s cubic-bezier(0.4, 0, 0.2, 1);"></div>
                </div>
            </div>
            @endforeach
        </div>

        <div style="margin-top: 2rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <a href="{{ route('rt.pengaduan.index', ['status'=>'dikirim']) }}" class="btn btn-outline" style="justify-content: center; background: #eff6ff; border-color: #bfdbfe; color: #1e40af;">
                <i class="fas fa-bolt"></i> Laporan Baru
            </a>
            <a href="{{ route('rt.pengaduan.index') }}" class="btn btn-primary" style="justify-content: center;">
                <i class="fas fa-list-ul"></i> Semua Laporan
            </a>
        </div>
    </div>

    {{-- Recent Pengaduan --}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Aktivitas Terbaru</h3>
            <a href="{{ route('rt.pengaduan.index') }}" style="font-size: 0.875rem; font-weight: 700;">Kelola Semua</a>
        </div>
        
        @if($pengaduanTerbaru->isEmpty())
            <div style="text-align:center; padding:3rem 0; color:var(--text-muted);">
                <i class="fas fa-stream" style="font-size:2.5rem; opacity:.2; display:block; margin-bottom:1rem;"></i>
                <p style="font-weight: 500;">Belum ada pengaduan dari warga.</p>
            </div>
        @else
            <div style="display:flex; flex-direction:column; gap:0.75rem;">
                @foreach($pengaduanTerbaru as $p)
                <a href="{{ route('rt.pengaduan.show', $p) }}" style="display:flex; align-items:center; justify-content:space-between; background:white; border: 1px solid var(--border); border-radius:var(--radius-sm); padding:1rem; transition: all var(--transition); text-decoration: none;" onmouseover="this.style.borderColor='var(--primary)'; this.style.backgroundColor='var(--bg)'" onmouseout="this.style.borderColor='var(--border)'; this.style.backgroundColor='white'">
                    <div style="flex: 1;">
                        <div style="font-weight:700; font-size:0.9375rem; color: var(--text); margin-bottom: 0.25rem;">{{ Str::limit($p->judul, 35) }}</div>
                        <div style="font-size:0.8125rem; color:var(--text-muted); font-weight: 500;">
                            Oleh <strong>{{ $p->user->name }}</strong> • {{ $p->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <span class="badge badge-{{ $p->status }}">{{ $p->status_label }}</span>
                </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
