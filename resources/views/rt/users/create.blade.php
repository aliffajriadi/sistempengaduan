@extends('layouts.app')
@section('title', 'Tambah Pengguna')

@section('content')
<div class="page-header">
    <div class="breadcrumb">
        <a href="{{ route('rt.dashboard') }}">Dashboard</a>
        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
        <a href="{{ route('rt.users.index') }}">Kelola Pengguna</a>
        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
        <span>Tambah</span>
    </div>
    <h1 class="page-title">Tambah Pengguna Baru 👤</h1>
    <p class="page-subtitle">Daftarkan akun masyarakat atau pengurus RT baru ke dalam sistem.</p>
</div>

<div style="max-width: 700px;">
    <div class="card">
        <form method="POST" action="{{ route('rt.users.store') }}">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label class="form-label" style="display: block; font-weight: 700; margin-bottom: 0.5rem; font-size: 0.875rem;">Nama Lengkap <span style="color: var(--danger);">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Nama lengkap pengguna" value="{{ old('name') }}" required>
                    @error('name') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label class="form-label" style="display: block; font-weight: 700; margin-bottom: 0.5rem; font-size: 0.875rem;">Email <span style="color: var(--danger);">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="Alamat email aktif" value="{{ old('email') }}" required>
                    @error('email') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</div> @enderror
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label class="form-label" style="display: block; font-weight: 700; margin-bottom: 0.5rem; font-size: 0.875rem;">Role Sistem <span style="color: var(--danger);">*</span></label>
                    <select name="role" class="form-control" required>
                        <option value="masyarakat" {{ old('role') == 'masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                        <option value="rt" {{ old('role') == 'rt' ? 'selected' : '' }}>Pengurus RT</option>
                    </select>
                    @error('role') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</div> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label class="form-label" style="display: block; font-weight: 700; margin-bottom: 0.5rem; font-size: 0.875rem;">Password <span style="color: var(--danger);">*</span></label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                    @error('password') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label class="form-label" style="display: block; font-weight: 700; margin-bottom: 0.5rem; font-size: 0.875rem;">Nomor HP</label>
                <input type="text" name="no_hp" class="form-control" placeholder="Contoh: 0812xxxxxxxx" value="{{ old('no_hp') }}">
                @error('no_hp') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</div> @enderror
            </div>

            <div class="form-group" style="margin-bottom: 2rem;">
                <label class="form-label" style="display: block; font-weight: 700; margin-bottom: 0.5rem; font-size: 0.875rem;">Alamat Lengkap</label>
                <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat domisili warga">{{ old('alamat') }}</textarea>
                @error('alamat') <div style="color: var(--danger); font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</div> @enderror
            </div>

            <div style="display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary" style="padding: 0.75rem 2rem;">
                    <i class="fas fa-save"></i> Simpan Pengguna
                </button>
                <a href="{{ route('rt.users.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
