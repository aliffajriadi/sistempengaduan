@extends('layouts.auth')
@section('title', 'Daftar')

@section('content')
<div class="auth-card">
    <h2>Buat Akun Baru</h2>

    @if($errors->any())
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> Terdapat kesalahan pada input Anda.</div>
    @endif

    <form method="POST" action="{{ route('register.post') }}">
        @csrf

        <div class="form-group">
            <label class="form-label" for="name">Nama Lengkap</label>
            <div class="input-wrap">
                <i class="fas fa-user"></i>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Nama lengkap Anda" value="{{ old('name') }}" required autofocus>
            </div>
            @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Alamat Email</label>
            <div class="input-wrap">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="nama@email.com" value="{{ old('email') }}" required>
            </div>
            @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Min. 8 karakter" required>
                </div>
                @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Konfirmasi</label>
                <div class="input-wrap">
                    <i class="fas fa-shield-check"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control" placeholder="Ulangi" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="no_hp">Nomor HP</label>
            <div class="input-wrap">
                <i class="fas fa-phone"></i>
                <input type="text" id="no_hp" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                    placeholder="08xxxxxxxxxx" value="{{ old('no_hp') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                placeholder="Alamat lengkap tempat tinggal">{{ old('alamat') }}</textarea>
        </div>

        <button type="submit" class="btn-primary">
            Daftar Sekarang <i class="fas fa-user-plus"></i>
        </button>
    </form>

    <div class="auth-footer">
        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
    </div>
</div>
@endsection
