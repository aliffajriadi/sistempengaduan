@extends('layouts.app')
@section('title', 'Buat Laporan')

@section('content')
<div class="page-header">
    <div class="breadcrumb">
        <a href="{{ route('masyarakat.dashboard') }}">Dashboard</a>
        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
        <a href="{{ route('masyarakat.pengaduan.index') }}">Laporan Saya</a>
        <i class="fas fa-chevron-right" style="font-size:.7rem;"></i>
        <span>Buat Laporan</span>
    </div>
    <h1 class="page-title">Sampaikan Aspirasi & Keluhan ✍️</h1>
    <p class="page-subtitle">Laporkan masalah di lingkungan Anda untuk segera ditangani oleh pengurus RT.</p>
</div>

<div style="max-width: 800px; margin: 0 auto;">
    <div class="card" style="padding: 2rem;">
        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <strong>Mohon periksa kembali:</strong>
                    <ul style="margin-top: 0.5rem; padding-left: 1.25rem; font-size: 0.85rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('masyarakat.pengaduan.store') }}" enctype="multipart/form-data" id="form-pengaduan">
            @csrf

            <div class="grid-2" style="margin-bottom: 1.5rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" for="kategori_id">Kategori <span class="req">*</span></label>
                    <select id="kategori_id" name="kategori_id" class="form-control" required>
                        <option value="">— Pilih Kategori —</option>
                        @foreach($kategoriList as $k)
                            <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" for="lokasi">Lokasi Kejadian</label>
                    <input type="text" id="lokasi" name="lokasi" class="form-control" placeholder="Contoh: Depan Blok A / Lapangan" value="{{ old('lokasi') }}">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="judul">Judul Laporan <span class="req">*</span></label>
                <input type="text" id="judul" name="judul" class="form-control" placeholder="Apa inti dari laporan Anda?" value="{{ old('judul') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="isi_pengaduan">Detail Laporan <span class="req">*</span></label>
                <textarea id="isi_pengaduan" name="isi_pengaduan" class="form-control" rows="6" placeholder="Jelaskan secara rinci kronologi atau detail masalahnya..." required>{{ old('isi_pengaduan') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Bukti Foto / Dokumen <span style="font-weight: 500; color: var(--text-muted);">(Opsional, maks. 5 file)</span></label>
                <div class="file-upload-area" id="upload-area" onclick="document.getElementById('bukti').click()">
                    <i class="fas fa-camera-retro"></i>
                    <p>Klik untuk memilih file atau <span>seret file ke sini</span></p>
                    <p style="font-size: 0.75rem; margin-top: 0.5rem; opacity: 0.7;">Format: JPG, PNG, PDF (Maks. 5MB per file)</p>
                </div>
                <input type="file" id="bukti" name="bukti[]" multiple accept=".jpg,.jpeg,.png,.pdf" style="display: none;" onchange="handleFiles(this.files)">
                
                <div class="file-preview-list" id="file-preview">
                    {{-- Preview items will be injected here --}}
                </div>
            </div>

            <div style="margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border); display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary" style="padding: 0.875rem 2.5rem; font-size: 1rem;">
                    <i class="fas fa-paper-plane"></i> Kirim Laporan Sekarang
                </button>
                <a href="{{ route('masyarakat.pengaduan.index') }}" class="btn btn-outline" style="padding: 0.875rem 1.5rem;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const uploadArea = document.getElementById('upload-area');
    const fileInput  = document.getElementById('bukti');
    const preview    = document.getElementById('file-preview');
    let   fileList   = [];

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, e => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, e => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
        });
    });

    uploadArea.addEventListener('drop', e => {
        handleFiles(e.dataTransfer.files);
    });

    function handleFiles(files) {
        const remaining = 5 - fileList.length;
        const newFiles = [...files].slice(0, remaining);
        fileList.push(...newFiles);
        renderPreview();
        updateInput();
    }

    function removeFile(index) {
        fileList.splice(index, 1);
        renderPreview();
        updateInput();
    }

    function renderPreview() {
        preview.innerHTML = '';
        fileList.forEach((file, index) => {
            const item = document.createElement('div');
            item.className = 'file-preview-item';
            
            const isImg = file.type.startsWith('image/');
            const icon = isImg ? 'fa-image' : 'fa-file-alt';
            
            item.innerHTML = `
                <i class="fas ${icon}" style="color: var(--primary);"></i>
                <span style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.name}</span>
                <button type="button" onclick="removeFile(${index})" style="margin-left: auto;">
                    <i class="fas fa-times"></i>
                </button>
            `;
            preview.appendChild(item);
        });
    }

    function updateInput() {
        const dt = new DataTransfer();
        fileList.forEach(file => dt.items.add(file));
        fileInput.files = dt.files;
    }
</script>
@endpush
