@extends('layouts.app')
@section('title', 'Edit Kategori')

@section('content')
<div class="page-header">
    <div class="breadcrumb">
        <a href="{{ route('rt.dashboard') }}">Dashboard</a>
        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
        <a href="{{ route('rt.kategori.index') }}">Kategori</a>
        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
        <span>Edit</span>
    </div>
    <h1 class="page-title">Edit Kategori Pengaduan</h1>
</div>

<div style="max-width:560px;">
    <div class="card">
        @if($errors->any())
            <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i><span>{{ $errors->first() }}</span></div>
        @endif

        <form method="POST" action="{{ route('rt.kategori.update', $kategori) }}">
            @csrf @method('PUT')

            <div class="form-group">
                <label class="form-label" for="nama_kategori">Nama Kategori <span class="req">*</span></label>
                <input type="text" id="nama_kategori" name="nama_kategori"
                    class="form-control @error('nama_kategori') is-invalid @enderror"
                    value="{{ old('nama_kategori', $kategori->nama_kategori) }}" maxlength="100" required>
                @error('nama_kategori')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="deskripsi">Deskripsi <span style="color:var(--text-muted);font-weight:400;">(opsional)</span></label>
                <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                <a href="{{ route('rt.kategori.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
