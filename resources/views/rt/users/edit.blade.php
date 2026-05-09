@extends('layouts.app')
@section('title', 'Edit Pengguna')

@section('content')
<div class="page-header">
    <div class="breadcrumb">
        <a href="{{ route('rt.dashboard') }}">Dashboard</a>
        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
        <a href="{{ route('rt.users.index') }}">Pengguna</a>
        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
        <span>Edit</span>
    </div>
    <h1 class="page-title">Edit Pengguna</h1>
</div>

<div style="max-width:600px;">
    <div class="card">
        @if($errors->any())
            <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i><div>{{ $errors->first() }}</div></div>
        @endif

        <form method="POST" action="{{ route('rt.users.update', $user) }}">
            @csrf @method('PUT')

            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label" for="name">Nama Lengkap <span class="req">*</span></label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}" required maxlength="100">
                    @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email <span class="req">*</span></label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label" for="role">Role <span class="req">*</span></label>
                    <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" required>
                        <option value="masyarakat" {{ old('role', $user->role) == 'masyarakat' ? 'selected':'' }}>Masyarakat</option>
                        <option value="rt" {{ old('role', $user->role) == 'rt' ? 'selected':'' }}>RT</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="no_hp">Nomor HP</label>
                    <input type="text" id="no_hp" name="no_hp" class="form-control"
                        value="{{ old('no_hp', $user->no_hp) }}" maxlength="20">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" class="form-control" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
            </div>

            <hr class="divider">
            <div class="form-group">
                <label class="form-label" for="password">Password Baru <span style="color:var(--text-muted);font-weight:400;">(kosongkan jika tidak diubah)</span></label>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Min. 8 karakter">
                @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="{{ route('rt.users.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
