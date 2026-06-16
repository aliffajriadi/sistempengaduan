<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISPEM - Kelurahan Sungai Lekop</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-pattern {
            background-color: #f8fafc;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2310b981' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-emerald-600 flex items-center justify-center text-white">
                    <i class="fas fa-building text-lg"></i>
                </div>
                <div>
                    <div class="font-bold text-lg tracking-tight text-slate-900 leading-none">SISPEM</div>
                    <div class="text-xs text-slate-500 font-medium mt-1">Kel. Sungai Lekop</div>
                </div>
            </div>
            <div class="hidden md:flex gap-8 items-center text-sm font-semibold text-slate-600">
                <a href="#beranda" class="hover:text-emerald-600 transition-colors">Beranda</a>
                <a href="#layanan" class="hover:text-emerald-600 transition-colors">Layanan</a>
                <a href="#alur" class="hover:text-emerald-600 transition-colors">Alur Pelaporan</a>
            </div>
            <div class="flex gap-3 items-center">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-emerald-600 transition-colors px-3 py-2 hidden sm:block">Masuk</a>
                <a href="{{ route('register') }}" class="text-sm font-bold bg-emerald-600 text-white px-5 py-2.5 rounded-md hover:bg-emerald-700 transition-colors shadow-sm">
                    Buat Laporan / Daftar
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 px-6 hero-pattern min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-12">
            <div class="w-full lg:w-1/2 text-center lg:text-left">
                <div class="inline-block px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-700 font-semibold text-xs mb-6 border border-emerald-200">
                    Pelayanan Masyarakat Digital
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight mb-6 text-slate-900 leading-tight">
                    Sistem Pengaduan Warga <br>
                    <span class="text-emerald-600">Kelurahan Sungai Lekop</span>
                </h1>
                <p class="text-lg text-slate-600 mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                    Sampaikan laporan, keluhan, dan aspirasi Anda terkait infrastruktur dan lingkungan di wilayah Kelurahan Sungai Lekop dengan mudah, cepat, dan transparan.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-6 py-3.5 rounded-md bg-emerald-600 text-white font-bold text-base hover:bg-emerald-700 transition-colors shadow-md flex items-center justify-center gap-2">
                        <i class="fas fa-edit"></i> Buat Laporan Baru
                    </a>
                    <a href="#alur" class="w-full sm:w-auto px-6 py-3.5 rounded-md bg-white border border-slate-300 text-slate-700 font-bold text-base hover:bg-slate-50 transition-colors flex items-center justify-center">
                        Pelajari Alur
                    </a>
                </div>
            </div>
            
            <div class="w-full lg:w-1/2 relative">
                <!-- Decorative background elements -->
                <div class="absolute -inset-4 bg-emerald-100 rounded-3xl transform rotate-3 scale-105 z-0"></div>
                <div class="absolute -inset-4 bg-emerald-600 rounded-3xl transform -rotate-2 scale-105 z-0 opacity-10"></div>
                
                <!-- Main Image -->
                <div class="relative z-10 bg-white p-2 rounded-2xl shadow-xl border border-slate-100">
                    <img src="/images/images.jpeg" alt="Pelayanan Masyarakat" class="rounded-xl w-full h-auto object-cover aspect-video">
                </div>
                
                <!-- Floating Card -->
                <div class="absolute -bottom-6 -left-6 z-20 bg-white p-4 rounded-xl shadow-lg border border-slate-100 flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xl">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-slate-900">Transparan</div>
                        <div class="text-xs text-slate-500">Dipantau langsung oleh RT</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="layanan" class="py-20 bg-white border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Layanan Terpadu SISPEM</h2>
                <div class="w-20 h-1 bg-emerald-500 mx-auto rounded-full mb-6"></div>
                <p class="text-slate-600 max-w-2xl mx-auto">Sistem ini memfasilitasi komunikasi antara warga dengan pengurus RT di lingkungan Kelurahan Sungai Lekop.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-200 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-600 mb-6">
                        <i class="fas fa-bullhorn text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-slate-900">Laporan Keamanan & Fasilitas</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Laporkan kerusakan jalan, lampu penerangan padam, atau gangguan keamanan di lingkungan Anda.</p>
                </div>
                <!-- Service 2 -->
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-200 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 mb-6">
                        <i class="fas fa-search-location text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-slate-900">Pantau Status Laporan</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Lihat perkembangan laporan Anda secara transparan, apakah sedang diproses atau sudah selesai ditindaklanjuti.</p>
                </div>
                <!-- Service 3 -->
                <div class="bg-slate-50 p-8 rounded-2xl border border-slate-200 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 rounded-lg bg-amber-100 flex items-center justify-center text-amber-600 mb-6">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-slate-900">Informasi Agenda Warga</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Dapatkan informasi jadwal kegiatan, rapat warga, dan kegiatan kelurahan lainnya.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works -->
    <section id="alur" class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="w-full lg:w-1/2">
                    <h2 class="text-3xl font-bold text-slate-900 mb-6">Alur Pengaduan</h2>
                    <p class="text-slate-600 mb-8 text-base">Proses pelaporan dirancang agar terstruktur dan mudah diikuti oleh seluruh masyarakat Kelurahan Sungai Lekop.</p>
                    
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-lg">1</div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900 mb-1">Daftar & Login Akun</h4>
                                <p class="text-slate-600 text-sm">Warga harus mendaftarkan akun sesuai dengan identitas dan alamat RT di Kelurahan Sungai Lekop.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-lg">2</div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900 mb-1">Tulis Laporan / Keluhan</h4>
                                <p class="text-slate-600 text-sm">Jelaskan detail masalah, sertakan foto sebagai bukti, dan pilih kategori pengaduan.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-lg">3</div>
                            <div>
                                <h4 class="text-lg font-bold text-slate-900 mb-1">Tindak Lanjut oleh RT</h4>
                                <p class="text-slate-600 text-sm">Pengurus RT akan memverifikasi laporan Anda dan melakukan penanganan di lapangan.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="w-full lg:w-1/2">
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                        <h4 class="font-bold text-slate-900 mb-6 text-center">Status Laporan di Sistem</h4>
                        <div class="space-y-4">
                            <div class="p-4 border border-slate-100 rounded-lg flex items-center justify-between bg-slate-50">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-paper-plane text-blue-500"></i>
                                    <span class="font-semibold text-sm text-slate-700">Laporan Dikirim</span>
                                </div>
                                <span class="text-xs font-bold px-2 py-1 bg-blue-100 text-blue-700 rounded">Baru</span>
                            </div>
                            <div class="p-4 border border-slate-100 rounded-lg flex items-center justify-between bg-slate-50">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-cog text-amber-500"></i>
                                    <span class="font-semibold text-sm text-slate-700">Laporan Diproses</span>
                                </div>
                                <span class="text-xs font-bold px-2 py-1 bg-amber-100 text-amber-700 rounded">Proses</span>
                            </div>
                            <div class="p-4 border border-emerald-100 rounded-lg flex items-center justify-between bg-emerald-50">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-check-circle text-emerald-500"></i>
                                    <span class="font-semibold text-sm text-emerald-800">Laporan Selesai</span>
                                </div>
                                <span class="text-xs font-bold px-2 py-1 bg-emerald-200 text-emerald-800 rounded">Selesai</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-800 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 rounded bg-emerald-600 flex items-center justify-center text-white">
                            <i class="fas fa-building text-sm"></i>
                        </div>
                        <span class="font-bold text-xl text-white">SISPEM</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-sm">
                        Sistem Pengaduan Masyarakat Kelurahan Sungai Lekop. Membangun lingkungan yang lebih baik melalui partisipasi aktif warga.
                    </p>
                </div>
                <div class="md:text-right">
                    <h4 class="text-white font-bold mb-4">Pusat Bantuan</h4>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><i class="fas fa-map-marker-alt w-5 text-center"></i> Kantor Kelurahan Sungai Lekop</li>
                        <li><i class="fas fa-envelope w-5 text-center"></i> admin@sungailekop.go.id</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-slate-500 text-xs">
                    &copy; {{ date('Y') }} SISPEM - Kelurahan Sungai Lekop. Hak Cipta Dilindungi.
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
