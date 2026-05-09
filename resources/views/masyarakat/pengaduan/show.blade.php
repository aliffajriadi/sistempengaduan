@extends('layouts.app')
@section('title', 'Detail Pengaduan')

@section('content')
<div class="page-header">
    <div class="breadcrumb">
        <a href="{{ route('masyarakat.dashboard') }}">Dashboard</a>
        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
        <a href="{{ route('masyarakat.pengaduan.index') }}">Pengaduan Saya</a>
        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
        <span>Detail</span>
    </div>
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <h1 class="page-title" style="margin: 0;">Detail Pengaduan 📂</h1>
        <span class="badge badge-{{ $pengaduan->status }}" style="font-size: 0.9rem; padding: 0.5rem 1rem;">{{ $pengaduan->status_label }}</span>
    </div>
</div>

<div class="grid-responsive">
    {{-- Main Info --}}
    <div>
        <div class="card">
            <h2 style="font-size: 1.25rem; font-weight: 800; margin-bottom: 1.5rem; color: var(--text); line-height: 1.4;">{{ $pengaduan->judul }}</h2>

            <div style="display: flex; flex-wrap: wrap; gap: 0.75rem; margin-bottom: 1.5rem;">
                <div style="background: var(--bg-muted); border-radius: 8px; padding: 0.5rem 0.85rem; font-size: 0.8rem; border: 1px solid var(--border);">
                    <span style="color: var(--text-muted); font-weight: 600;">Kategori:</span>
                    <strong style="margin-left: 0.4rem; color: var(--primary);">{{ $pengaduan->kategori->nama_kategori ?? 'Umum' }}</strong>
                </div>
                @if($pengaduan->lokasi)
                <div style="background: var(--bg-muted); border-radius: 8px; padding: 0.5rem 0.85rem; font-size: 0.8rem; border: 1px solid var(--border);">
                    <i class="fas fa-map-marker-alt" style="color: var(--danger); margin-right: 0.4rem;"></i>
                    <span style="font-weight: 600;">{{ $pengaduan->lokasi }}</span>
                </div>
                @endif
                <div style="background: var(--bg-muted); border-radius: 8px; padding: 0.5rem 0.85rem; font-size: 0.8rem; border: 1px solid var(--border);">
                    <i class="fas fa-clock" style="color: var(--text-muted); margin-right: 0.4rem;"></i>
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
            <h3 class="card-title" style="margin-bottom: 1.25rem;"><i class="fas fa-paperclip" style="color: var(--primary); margin-right: 0.6rem;"></i>Bukti Pendukung</h3>
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

    {{-- Sidebar Status --}}
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        {{-- Status Timeline --}}
        <div class="card">
            <h3 class="card-title" style="margin-bottom: 1.5rem;"><i class="fas fa-tasks" style="color: var(--primary); margin-right: 0.6rem;"></i>Status Laporan</h3>

            @php
                $statuses = ['dikirim','diproses','selesai'];
                $current  = $pengaduan->status;
                $isDitolak = $current === 'ditolak';
            @endphp

            @if($isDitolak)
                <div class="alert alert-danger" style="margin: 0;"><i class="fas fa-times-circle"></i><span>Laporan Anda ditolak.</span></div>
            @else
                <div style="position: relative; padding-left: 1.5rem;">
                    @foreach($statuses as $index => $s)
                    @php
                        $statusOrder = ['dikirim'=>0,'diproses'=>1,'selesai'=>2];
                        $isDone = $statusOrder[$current] >= $statusOrder[$s];
                        $isCurrent = $current === $s;
                        $labels = ['dikirim'=>'Laporan Dikirim','diproses'=>'Sedang Diproses','selesai'=>'Selesai / Ditutup'];
                    @endphp
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: {{ !$loop->last ? '2rem' : '0' }}; position: relative;">
                        @if(!$loop->last)
                        <div style="position: absolute; left: 0.5rem; top: 1.5rem; width: 2px; height: calc(100% + 0.5rem); background: {{ $statusOrder[$current] > $statusOrder[$s] ? 'var(--primary)' : 'var(--border)' }};"></div>
                        @endif
                        <div style="width: 18px; height: 18px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 0.6rem; background: {{ $isDone ? 'var(--primary)' : 'var(--bg-muted)' }}; border: 2px solid {{ $isDone ? 'var(--primary)' : 'var(--border)' }}; z-index: 1; color: #fff;">
                            @if($isDone)<i class="fas fa-check"></i>@endif
                        </div>
                        <div>
                            <div style="font-size: 0.9375rem; font-weight: {{ $isCurrent ? '800' : '600' }}; color: {{ $isDone ? 'var(--text)' : 'var(--text-muted)' }};">{{ $labels[$s] }}</div>
                            @if($isCurrent)
                                <div style="font-size: 0.75rem; color: var(--primary); font-weight: 700;">Status Saat Ini</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Catatan RT --}}
        @if($pengaduan->catatan_rt)
        <div class="card" style="border-left: 4px solid var(--primary);">
            <h3 class="card-title" style="font-size: 0.95rem; margin-bottom: 1rem;"><i class="fas fa-comment-dots" style="color: var(--primary); margin-right: 0.5rem;"></i>Tanggapan RT</h3>
            <div style="font-size: 0.9375rem; line-height: 1.6; color: var(--text); background: var(--bg); padding: 1rem; border-radius: 8px;">
                {{ $pengaduan->catatan_rt }}
            </div>
            @if($pengaduan->verifikator)
            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.75rem; font-weight: 600;">
                Oleh: <strong>{{ $pengaduan->verifikator->name }}</strong> 
                @if($pengaduan->tanggal_verifikasi) • {{ $pengaduan->tanggal_verifikasi->format('d M Y') }} @endif
            </div>
            @endif
        </div>
        @endif

        <a href="{{ route('masyarakat.pengaduan.index') }}" class="btn btn-outline" style="width: 100%; justify-content: center; padding: 0.875rem;">
            <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
        </a>
    </div>
</div>
@endsection
