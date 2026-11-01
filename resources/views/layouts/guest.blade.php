<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Perpustakaan Kerajaan') }}</title>
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <style>
        :root{--royal-navy:#172f4c;--royal-burgundy:#651d32;--royal-gold:#d8ad48;--royal-parchment:#f4edda}
        body{min-height:100vh;margin:0;background:linear-gradient(90deg,rgba(16,31,51,.88),rgba(16,31,51,.58)),url('/assets/img/home-bg.jpg') center/cover fixed;font-family:Georgia,'Times New Roman',serif}
        .auth-shell{min-height:100vh;display:flex;align-items:center;padding:48px 0}
        .auth-frame{max-width:980px;margin:auto;background:rgba(244,237,218,.97);border:2px solid var(--royal-gold);border-radius:3px;box-shadow:0 24px 70px rgba(5,18,35,.55);overflow:hidden}
        .auth-crest{width:66px;height:66px;background:var(--royal-burgundy);border:4px double var(--royal-gold);color:var(--royal-gold);clip-path:polygon(50% 0%,100% 18%,92% 82%,50% 100%,8% 82%,0 18%);display:flex;align-items:center;justify-content:center;font-size:1.15rem;font-weight:bold;margin:auto}
        .auth-side{min-height:520px;background:linear-gradient(160deg,rgba(23,47,76,.97),rgba(101,29,50,.92)),url('/assets/img/post-bg.jpg') center/cover;color:white;padding:42px;display:flex;flex-direction:column;justify-content:center;border-right:1px solid var(--royal-gold)}
        .auth-side h2{font-family:'Palatino Linotype',Georgia,serif;font-size:2.35rem;line-height:1.08}
        .auth-gold{color:var(--royal-gold)}
        .auth-panel{padding:42px 46px}
        .auth-panel .form-label{font-family:system-ui,sans-serif;color:#4b4033;font-size:.82rem;font-weight:700;text-transform:uppercase;letter-spacing:.05em}
        .auth-panel .form-control{border-radius:2px;border:1px solid #b7a888;background:#fffdf7;padding:.78rem .9rem}
        .auth-panel .form-control:focus{border-color:var(--royal-gold);box-shadow:0 0 0 .2rem rgba(216,173,72,.22)}
        .btn-royal{border-radius:2px;border:2px solid #f0cf7a;background:var(--royal-gold);color:#3a290e;font-family:system-ui,sans-serif;font-weight:800;padding:.78rem;box-shadow:inset 0 0 0 1px #a68131}
        .btn-royal:hover{background:#e4c269;color:#261a09}
        .auth-link{color:var(--royal-burgundy);font-weight:700;text-decoration:none}.auth-link:hover{color:#8b2946;text-decoration:underline}
        .auth-panel a{text-decoration:none}
        @media(max-width:767px){.auth-shell{padding:24px 14px}.auth-side{min-height:auto;padding:28px;text-align:center;border-right:0;border-bottom:1px solid var(--royal-gold)}.auth-side h2{font-size:1.75rem}.auth-panel{padding:32px 24px}}
    </style>
</head>
<body>
    <main class="auth-shell">
        <div class="container">
            <div class="auth-frame">
                <div class="row g-0">
                    <aside class="col-md-5 auth-side">
                        <div class="auth-crest mb-3">MB</div>
                        <p class="auth-gold text-uppercase small fw-bold mb-2" style="letter-spacing:.18em">Perpustakaan Kerajaan</p>
                        <h2>Gerbang Naskah & Pengetahuan</h2>
                        <p class="mt-3 mb-0 text-white-50">Masuk untuk mengakses katalog, mengelola koleksi, dan melanjutkan perjalanan literasi Anda.</p>
                    </aside>
                    <section class="col-md-7 auth-panel">{{ $slot }}</section>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
