@extends('layouts.auth')
@section('title', 'Masuk')

@section('content')
<div class="auth-card">
    <h2>Selamat Datang Kembali</h2>

    @if($errors->any())
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <div class="input-wrap">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
            </div>
            @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <div class="input-wrap">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Masukkan password" required>
            </div>
            @error('password')<span class="invalid-feedback">{{ $message }}</span>@enderror
        </div>

        <div class="remember-row">
            <label class="checkbox-group">
                <input type="checkbox" name="remember" id="remember">
                Ingat saya
            </label>
            {{-- <a href="#" style="font-size: 0.875rem; font-weight: 700; color: var(--primary);">Lupa password?</a> --}}
        </div>

        <button type="submit" class="btn-primary">
            Masuk <i class="fas fa-arrow-right"></i>
        </button>
    </form>

    <div class="auth-footer">
        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
    </div>
</div>
@endsection
