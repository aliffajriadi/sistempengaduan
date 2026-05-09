<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SISPEM - Sistem Pengaduan Masyarakat berbasis digital untuk pelayanan RT yang lebih baik">
    <title>@yield('title', 'SISPEM') | Sistem Pengaduan Masyarakat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:       #4f46e5;
            --primary-dark:  #3730a3;
            --primary-light: #e0e7ff;
            --secondary:     #0ea5e9;
            --success:       #10b981;
            --warning:       #f59e0b;
            --danger:        #ef4444;
            --info:          #3b82f6;

            --bg:            #f8fafc;
            --bg-alt:        #ffffff;
            --bg-muted:      #f1f5f9;
            --border:        #e2e8f0;
            --text:          #0f172a;
            --text-muted:    #64748b;
            --card:          #ffffff;
            --shadow:        0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md:     0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg:     0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);

            --radius:        12px;
            --radius-sm:     8px;
            --transition:    .2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            overflow-x: hidden;
        }

        a { color: var(--primary); text-decoration: none; transition: all var(--transition); }
        a:hover { color: var(--primary-dark); }

        /* ========== SIDEBAR (Desktop) ========== */
        .sidebar {
            width: 260px; height: 100vh;
            background: var(--bg-alt); border-right: 1px solid var(--border);
            position: fixed; left: 0; top: 0;
            display: flex; flex-direction: column; z-index: 50;
            transition: transform var(--transition);
        }

        .sidebar-header {
            padding: 1.5rem; display: flex; align-items: center; gap: 0.75rem;
            border-bottom: 1px solid var(--border);
        }

        .brand-icon {
            width: 40px; height: 40px; background: var(--primary); color: #fff;
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
            font-size: 1.25rem; box-shadow: 0 4px 10px rgba(79, 70, 229, 0.25);
        }

        .brand-name { font-weight: 800; font-size: 1.25rem; letter-spacing: -0.02em; color: var(--primary); }

        .sidebar-content { flex: 1; padding: 1.5rem 1rem; overflow-y: auto; }

        .menu-label {
            font-size: 0.75rem; font-weight: 700; text-transform: uppercase;
            color: var(--text-muted); letter-spacing: 0.05em; margin-bottom: 0.75rem; padding-left: 0.75rem;
        }

        .sidebar-link {
            display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem;
            border-radius: var(--radius-sm); color: var(--text-muted); font-weight: 600;
            font-size: 0.9375rem; margin-bottom: 0.25rem; transition: all var(--transition);
        }

        .sidebar-link i { font-size: 1.1rem; width: 24px; text-align: center; }
        .sidebar-link:hover { background: var(--bg); color: var(--primary); }
        .sidebar-link.active { background: var(--primary-light); color: var(--primary); }

        .sidebar-footer { padding: 1rem; border-top: 1px solid var(--border); }

        /* ========== TOP NAV ========== */
        .top-nav {
            position: fixed; top: 0; left: 260px; right: 0; height: 70px;
            background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border); display: flex;
            align-items: center; justify-content: space-between; padding: 0 2rem;
            z-index: 40; transition: all var(--transition);
        }

        .user-profile { display: flex; align-items: center; gap: 0.75rem; }
        .user-avatar {
            width: 36px; height: 36px; border-radius: 10px; background: var(--primary);
            color: #fff; display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.9rem; box-shadow: 0 4px 10px rgba(79, 70, 229, 0.2);
        }

        /* ========== LAYOUT & MAIN ========== */
        .main-wrapper { flex: 1; margin-left: 260px; padding-top: 70px; min-height: 100vh; transition: margin var(--transition); }
        .main-content { padding: 2rem; max-width: 1240px; margin: 0 auto; }

        /* ========== BOTTOM NAV ========== */
        .bottom-nav {
            position: fixed; bottom: 0; left: 0; right: 0; height: 70px;
            background: var(--bg-alt); border-top: 1px solid var(--border);
            display: none; justify-content: space-around; align-items: center;
            z-index: 100; padding-bottom: env(safe-area-inset-bottom);
        }

        .bottom-link {
            display: flex; flex-direction: column; align-items: center; gap: 0.25rem;
            color: var(--text-muted); font-size: 0.7rem; font-weight: 600; padding: 0.5rem; flex: 1;
        }
        .bottom-link i { font-size: 1.25rem; }
        .bottom-link.active { color: var(--primary); }

        /* ========== CARDS ========== */
        .card { background: var(--card); border: 1px solid var(--border); border-radius: var(--radius); padding: 1.5rem; box-shadow: var(--shadow); margin-bottom: 1.5rem; }
        .card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; }
        .card-title { font-weight: 700; font-size: 1.1rem; }

        /* ========== STATS ========== */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: var(--bg-alt); border: 1px solid var(--border); border-radius: var(--radius); padding: 1.5rem; display: flex; align-items: center; gap: 1rem; box-shadow: var(--shadow); }
        .stat-icon { width: 54px; height: 54px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .stat-icon.purple { background: #eef2ff; color: #4f46e5; }
        .stat-icon.blue   { background: #eff6ff; color: #3b82f6; }
        .stat-icon.green  { background: #ecfdf5; color: #10b981; }
        .stat-icon.amber  { background: #fffbeb; color: #f59e0b; }
        .stat-icon.red    { background: #fef2f2; color: #ef4444; }
        .stat-value { font-size: 1.5rem; font-weight: 800; }
        .stat-label { font-size: 0.875rem; color: var(--text-muted); font-weight: 500; }

        /* ========== TABLE ========== */
        .table-container { overflow-x: auto; border-radius: var(--radius-sm); }
        table { width: 100%; border-collapse: collapse; }
        th { background: var(--bg); padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--text-muted); border-bottom: 1px solid var(--border); }
        td { padding: 1rem; border-bottom: 1px solid var(--border); font-size: 0.9rem; }

        /* ========== BADGES ========== */
        .badge { padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.75rem; font-weight: 700; }
        .badge-dikirim  { background: #dbeafe; color: #1e40af; }
        .badge-diproses { background: #fef3c7; color: #92400e; }
        .badge-selesai  { background: #d1fae5; color: #065f46; }
        .badge-ditolak  { background: #fee2e2; color: #991b1b; }
        .badge-rt       { background: #e0e7ff; color: #4338ca; }
        .badge-masyarakat { background: #e0f2fe; color: #0369a1; }

        /* ========== BUTTONS ========== */
        .btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1.25rem; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.875rem; cursor: pointer; border: none; transition: all var(--transition); }
        .btn-sm { padding: 0.4rem 0.8rem; font-size: 0.8rem; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-outline { background: #fff; border: 1px solid var(--border); color: var(--text); }
        .btn-danger { background: var(--danger); color: #fff; }

        .btn-logout {
            width: 100%; justify-content: center; background: #fee2e2; color: #b91c1c; border: none;
            padding: 0.75rem; border-radius: var(--radius-sm); font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 0.5rem;
        }

        .form-control {
            width: 100%; padding: 0.75rem 1rem; border: 1.5px solid var(--border); border-radius: var(--radius-sm);
            font-family: inherit; font-size: 0.9375rem; transition: all var(--transition); outline: none; background: #fff;
        }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }

        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-weight: 700; font-size: 0.875rem; color: var(--text); margin-bottom: 0.5rem; }
        .req { color: var(--danger); margin-left: 2px; }

        /* ========== FILE UPLOAD ========== */
        .file-upload-area {
            border: 2px dashed var(--border); border-radius: var(--radius);
            padding: 2.5rem 1.5rem; text-align: center; cursor: pointer;
            transition: all var(--transition); background: var(--bg);
        }
        .file-upload-area:hover, .file-upload-area.dragover {
            border-color: var(--primary); background: var(--primary-light);
        }
        .file-upload-area i { font-size: 2.5rem; color: var(--primary); margin-bottom: 1rem; display: block; opacity: 0.5; }
        .file-upload-area p { color: var(--text-muted); font-size: 0.9375rem; font-weight: 500; }
        .file-upload-area span { color: var(--primary); font-weight: 700; }
        .file-preview-list { display: flex; flex-wrap: wrap; gap: 0.75rem; margin-top: 1rem; }
        .file-preview-item { background: var(--bg-muted); border-radius: var(--radius-sm); padding: 0.5rem 0.875rem; font-size: 0.8125rem; display: flex; align-items: center; gap: 0.5rem; border: 1px solid var(--border); }
        .file-preview-item button { background: none; border: none; color: var(--danger); cursor: pointer; padding: 0; font-size: 1rem; }

        .breadcrumb { display: flex; align-items: center; gap: 0.5rem; font-size: 0.8125rem; color: var(--text-muted); margin-bottom: 0.75rem; font-weight: 500; }
        .breadcrumb a { color: var(--text-muted); }
        .breadcrumb a:hover { color: var(--primary); }
        .breadcrumb span { color: var(--text); font-weight: 700; }

        .alert { padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; font-weight: 600; }
        .alert-success { background: #d1fae5; color: #065f46; }
        .alert-danger { background: #fee2e2; color: #991b1b; }

        .desktop-table { display: block; }
        .mobile-list { display: none; }

        .grid-responsive {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            align-items: start;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        @media (max-width: 992px) {
            .desktop-only { display: none; }
            .mobile-only { display: block; }
            .desktop-table { display: none; }
            .mobile-list { display: flex; flex-direction: column; gap: 0.75rem; }
            .grid-responsive, .grid-2 { grid-template-columns: 1fr; }
            .sidebar { transform: translateX(-100%); }
            .top-nav { left: 0; padding: 0 1rem; }
            .main-wrapper { margin-left: 0; }
            .bottom-nav { display: flex; }
            .main-content { padding-bottom: 100px; padding: 1.5rem; }
        }

        @media (max-width: 640px) {
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>
    @auth
    <!-- Sidebar (Desktop) -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="brand-icon"><i class="fas fa-shield-halved"></i></div>
            <div class="brand-name">SISPEM</div>
        </div>
        <div class="sidebar-content">
            <div class="menu-label">Menu Utama</div>
            @if(auth()->user()->role === 'rt')
                <a href="{{ route('rt.dashboard') }}" class="sidebar-link {{ request()->routeIs('rt.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i> Dashboard
                </a>
                <a href="{{ route('rt.pengaduan.index') }}" class="sidebar-link {{ request()->routeIs('rt.pengaduan.*') ? 'active' : '' }}">
                    <i class="fas fa-inbox"></i> Pengaduan
                </a>
                <a href="{{ route('rt.kegiatan.index') }}" class="sidebar-link {{ request()->routeIs('rt.kegiatan.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i> Agenda Kegiatan
                </a>
                <a href="{{ route('rt.users.index') }}" class="sidebar-link {{ request()->routeIs('rt.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Pengguna
                </a>
                <a href="{{ route('rt.kategori.index') }}" class="sidebar-link {{ request()->routeIs('rt.kategori.*') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i> Kategori
                </a>
            @else
                <a href="{{ route('masyarakat.dashboard') }}" class="sidebar-link {{ request()->routeIs('masyarakat.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Beranda
                </a>
                <a href="{{ route('masyarakat.pengaduan.index') }}" class="sidebar-link {{ request()->routeIs('masyarakat.pengaduan.*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i> Pengaduan Saya
                </a>
                <a href="{{ route('masyarakat.pengaduan.create') }}" class="sidebar-link {{ request()->routeIs('masyarakat.pengaduan.create') ? 'active' : '' }}">
                    <i class="fas fa-plus-circle"></i> Buat Laporan
                </a>
            @endif
        </div>
        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Top Nav -->
    <header class="top-nav">
        <h2 style="font-size: 1.15rem; font-weight: 700;">@yield('title')</h2>
        <div class="user-profile">
            <div style="text-align: right; line-height: 1.2;" class="desktop-only">
                <div style="font-weight: 700; font-size: 0.875rem;">{{ auth()->user()->name }}</div>
                <div style="font-size: 0.75rem; color: var(--text-muted);">{{ auth()->user()->role === 'rt' ? 'Pengurus RT' : 'Masyarakat' }}</div>
            </div>
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <!-- Logout for mobile -->
            <form method="POST" action="{{ route('logout') }}" class="mobile-only">
                @csrf
                <button type="submit" style="background: none; border: none; color: var(--danger); font-size: 1.2rem; cursor: pointer;">
                    <i class="fas fa-power-off"></i>
                </button>
            </form>
        </div>
    </header>

    <!-- Bottom Nav (Mobile) -->
    <nav class="bottom-nav">
        @if(auth()->user()->role === 'rt')
            <a href="{{ route('rt.dashboard') }}" class="bottom-link {{ request()->routeIs('rt.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('rt.pengaduan.index') }}" class="bottom-link {{ request()->routeIs('rt.pengaduan.*') ? 'active' : '' }}">
                <i class="fas fa-inbox"></i><span>Laporan</span>
            </a>
            <a href="{{ route('rt.kegiatan.index') }}" class="bottom-link {{ request()->routeIs('rt.kegiatan.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i><span>Agenda</span>
            </a>
            <a href="{{ route('rt.users.index') }}" class="bottom-link {{ request()->routeIs('rt.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i><span>Warga</span>
            </a>
            <a href="{{ route('rt.kategori.index') }}" class="bottom-link {{ request()->routeIs('rt.kategori.*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i><span>Kategori</span>
            </a>
        @else
            <a href="{{ route('masyarakat.dashboard') }}" class="bottom-link {{ request()->routeIs('masyarakat.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i><span>Beranda</span>
            </a>
            <a href="{{ route('masyarakat.pengaduan.create') }}" class="bottom-link {{ request()->routeIs('masyarakat.pengaduan.create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle" style="font-size: 1.75rem; color: var(--primary);"></i><span>Lapor</span>
            </a>
            <a href="{{ route('masyarakat.pengaduan.index') }}" class="bottom-link {{ request()->routeIs('masyarakat.pengaduan.*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list"></i><span>Riwayat</span>
            </a>
        @endif
    </nav>
    @endauth

    <div class="main-wrapper" style="{{ !auth()->check() ? 'margin-left: 0; padding-top: 0;' : '' }}">
        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
            @endif
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
