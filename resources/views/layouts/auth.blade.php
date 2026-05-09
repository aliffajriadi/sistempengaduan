<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login') | SISPEM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --primary-light: #e0e7ff;
            --secondary: #0ea5e9;
            --danger: #ef4444;
            --success: #10b981;
            --bg: #f8fafc;
            --border: #e2e8f0;
            --text: #0f172a;
            --text-muted: #64748b;
            --radius: 16px;
            --radius-sm: 10px;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg);
            background-image: radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), 
                              radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%), 
                              radial-gradient(at 100% 0%, hsla(339,49%,30%,1) 0, transparent 50%);
            background-image: radial-gradient(circle at 10% 20%, rgba(79, 70, 229, 0.05) 0%, transparent 40%),
                              radial-gradient(circle at 90% 80%, rgba(14, 165, 233, 0.05) 0%, transparent 40%);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }
        .auth-container {
            width: 100%; max-width: 440px;
        }
        .auth-logo {
            text-align: center; margin-bottom: 2.5rem;
        }
        .auth-logo .logo-icon {
            width: 64px; height: 64px;
            background: var(--primary);
            border-radius: 18px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 1.75rem; color: #fff; margin-bottom: 1rem;
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.4);
        }
        .auth-logo h1 { font-size: 1.75rem; font-weight: 800; letter-spacing: -0.025em; color: var(--primary); }
        .auth-logo p { color: var(--text-muted); font-size: 0.9375rem; margin-top: 0.25rem; font-weight: 500; }
        
        .auth-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 2.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .auth-card h2 { font-size: 1.25rem; font-weight: 700; margin-bottom: 2rem; text-align: center; }
        
        .form-group { margin-bottom: 1.5rem; }
        .form-label { display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--text); }
        
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 1rem; }
        
        .form-control {
            width: 100%; padding: 0.75rem 1rem 0.75rem 2.75rem;
            background: #ffffff; border: 1.5px solid var(--border);
            border-radius: var(--radius-sm); color: var(--text);
            font-size: 0.9375rem; font-family: inherit;
            outline: none; transition: all 0.2s;
        }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); }
        .form-control::placeholder { color: #94a3b8; }
        .form-control.is-invalid { border-color: var(--danger); }
        
        .invalid-feedback { font-size: 0.8125rem; color: var(--danger); margin-top: 0.4rem; display: block; font-weight: 500; }
        
        .btn-primary {
            width: 100%; padding: 0.875rem;
            background: var(--primary);
            color: #fff; border: none; border-radius: var(--radius-sm);
            font-size: 1rem; font-weight: 700; cursor: pointer;
            transition: all 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 0.6rem;
        }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
        
        .auth-footer { text-align: center; margin-top: 2rem; font-size: 0.9375rem; color: var(--text-muted); font-weight: 500; }
        .auth-footer a { color: var(--primary); font-weight: 700; }
        .auth-footer a:hover { text-decoration: underline; }
        
        .alert { padding: 1rem; border-radius: var(--radius-sm); font-size: 0.875rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; font-weight: 600; }
        .alert-danger { background: #fee2e2; border: 1px solid #fecaca; color: #b91c1c; }
        .alert-success { background: #d1fae5; border: 1px solid #a7f3d0; color: #065f46; }
        
        .remember-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; }
        .checkbox-group { display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; color: var(--text-muted); cursor: pointer; font-weight: 500; }
        .checkbox-group input[type="checkbox"] { accent-color: var(--primary); width: 16px; height: 16px; }
        
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        @media (max-width: 480px) { .form-grid { grid-template-columns: 1fr; } }
        
        textarea.form-control { min-height: 100px; padding-left: 1rem; resize: vertical; }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-logo">
            <div class="logo-icon"><i class="fas fa-shield-halved"></i></div>
            <h1>SISPEM</h1>
            <p>Sistem Pengaduan Masyarakat</p>
        </div>
        @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>
