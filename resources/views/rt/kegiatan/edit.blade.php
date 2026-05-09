@extends('layouts.app')
@section('title', 'Edit Kegiatan')

@section('content')
<div class="page-header">
    <div class="breadcrumb">
        <a href="{{ route('rt.dashboard') }}">Dashboard</a>
        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
        <a href="{{ route('rt.kegiatan.index') }}">Agenda Kegiatan</a>
        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
        <span>Edit</span>
    </div>
    <h1 class="page-title">Edit Agenda Kegiatan 🗓️</h1>
    <p class="page-subtitle">Perbarui informasi kegiatan atau acara lingkungan.</p>
</div>

<div style="max-width: 800px;">
    <div class="card">
        <form method="POST" action="{{ route('rt.kegiatan.update', $kegiatan) }}">
            @csrf
            @method('PUT')

            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label" style="display: block; font-weight: 700; margin-bottom: 0.5rem;">Judul Kegiatan <span style="color: var(--danger);">*</span></label>
                <input type="text" name="judul" class="form-control" placeholder="Contoh: Gotong Royong Kebersihan" value="{{ old('judul', $kegiatan->judul) }}" required>
                @error('judul') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</div> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div class="form-group">
                    <label class="form-label" style="display: block; font-weight: 700; margin-bottom: 0.5rem;">Tanggal Pelaksanaan <span style="color: var(--danger);">*</span></label>
                    <input type="date" name="tanggal_kegiatan" class="form-control" value="{{ old('tanggal_kegiatan', $kegiatan->tanggal_kegiatan->format('Y-m-d')) }}" required>
                    @error('tanggal_kegiatan') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" style="display: block; font-weight: 700; margin-bottom: 0.5rem;">Lokasi <span style="color: var(--danger);">*</span></label>
                    <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Balai Warga / Taman" value="{{ old('lokasi', $kegiatan->lokasi) }}" required>
                    @error('lokasi') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 2rem;">
                <label class="form-label" style="display: block; font-weight: 700; margin-bottom: 0.5rem;">Deskripsi / Detail Kegiatan <span style="color: var(--danger);">*</span></label>
                <textarea name="deskripsi" class="form-control" rows="6" placeholder="Jelaskan detail kegiatan..." required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                @error('deskripsi') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</div> @enderror
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary" style="padding: 0.75rem 2rem;">
                    <i class="fas fa-save"></i> Perbarui Agenda
                </button>
                <a href="{{ route('rt.kegiatan.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
