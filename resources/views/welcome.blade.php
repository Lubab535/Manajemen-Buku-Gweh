<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Perpustakaan Kerajaan') }}</title>
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <style>
        :root{--navy:#172f4c;--burgundy:#651d32;--gold:#d8ad48;--parchment:#f4edda;--ink:#342d24}
        body{margin:0;background:var(--parchment);color:var(--ink);font-family:Georgia,'Times New Roman',serif;background-image:radial-gradient(rgba(101,29,50,.07) 1px,transparent 1px);background-size:8px 8px}
        .castle-nav{background:#101f33!important;border-bottom:4px double var(--gold)}
        .brand-seal{width:44px;height:44px;background:var(--burgundy);border:3px double var(--gold);color:var(--gold);display:flex;align-items:center;justify-content:center;font-weight:700;clip-path:polygon(50% 0%,100% 15%,92% 85%,50% 100%,8% 85%,0 15%)}
        .hero-medieval{min-height:560px;background:linear-gradient(90deg,rgba(16,31,51,.97) 0%,rgba(23,47,76,.88) 50%,rgba(23,47,76,.28) 100%),url('/assets/img/home-bg.jpg') center/cover no-repeat;color:#fff;border-bottom:8px solid var(--burgundy)}
        .hero-medieval::after{content:"";display:block;height:16px;background:linear-gradient(135deg,var(--gold) 25%,transparent 25%) -8px 0/16px 16px,linear-gradient(225deg,var(--gold) 25%,transparent 25%) -8px 0/16px 16px;opacity:.9;margin-top:-16px}
        .eyebrow{color:var(--gold);letter-spacing:.22em;text-transform:uppercase;font-family:system-ui,sans-serif;font-size:.82rem;font-weight:800}
        .hero-title{font-size:clamp(2.5rem,5vw,5rem);line-height:.98;text-shadow:0 5px 24px rgba(0,0,0,.4);font-family:'Palatino Linotype',Georgia,serif}
        .ornament{color:var(--gold);letter-spacing:.5em;font-size:1rem}
        .btn-medieval-gold{background:var(--gold)!important;border:2px solid #f0cf7a!important;color:#3a290e!important;border-radius:2px;padding:.78rem 1.3rem;font-family:system-ui,sans-serif;font-weight:800;box-shadow:inset 0 0 0 1px #a68131,0 6px 16px rgba(0,0,0,.18)}
        .btn-medieval-gold:hover{background:#e4c269!important;color:#261a09!important;transform:translateY(-2px)}
        .btn-medieval-outline{border:2px solid var(--gold)!important;color:#f5e6b5!important;border-radius:2px;padding:.78rem 1.3rem;font-family:system-ui,sans-serif;font-weight:800}
        .section-medieval{border-top:1px solid rgba(101,29,50,.25);border-bottom:1px solid rgba(101,29,50,.18)}
        .chapter-card{background:rgba(255,252,244,.92);border:1px solid rgba(101,29,50,.2);border-top:6px solid var(--burgundy);border-radius:2px;box-shadow:0 14px 34px rgba(67,48,34,.1)}
        .chapter-number{width:62px;height:62px;margin-bottom:18px;background:var(--navy);border:3px double var(--gold);color:var(--gold);display:flex;align-items:center;justify-content:center;font-size:1.2rem;clip-path:polygon(50% 0%,100% 18%,92% 82%,50% 100%,8% 82%,0 18%)}
        .chapter-title{color:var(--burgundy);font-family:'Palatino Linotype',Georgia,serif}
        footer{background:#e9ddb9;border-top:2px solid var(--gold)!important;color:#665c49}
        @media(max-width:768px){.hero-medieval{min-height:500px}.hero-title{font-size:2.7rem}}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark castle-nav sticky-top">
    <div class="container py-2">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ url('/') }}"><span class="brand-seal">MB</span><span class="d-none d-sm-inline">Perpustakaan Kerajaan</span></a>
        <div class="ms-auto d-flex gap-2">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-medieval-gold btn-sm">Istana Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-medieval-gold btn-sm">Daftar</a>
            @endauth
        </div>
    </div>
</nav>

<!-- Catatan landing page: visual abad pertengahan disampaikan melalui suasana kerajaan, perkamen, segel, dan garis emas. -->
<header class="hero-medieval d-flex align-items-center">
    <div class="container py-5">
        <div class="col-lg-7">
            <p class="eyebrow mb-3">Arsip Pengetahuan Kerajaan</p>
            <h1 class="hero-title mb-4">Gerbang Menuju<br>Dunia Naskah & Buku</h1>
            <div class="ornament mb-4">◆ ◆ ◆</div>
            <p class="lead mb-4 text-light" style="max-width:650px">Jelajahi katalog perpustakaan, pelajari warisan literatur, dan kelola koleksi naskah dalam suatu kerajaan digital.</p>
            <div class="d-flex flex-wrap gap-3">
                @auth
                    <a href="{{ route('books.index') }}" class="btn btn-medieval-gold">Masuki Perpustakaan</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-medieval-gold">Mulai Perjalanan</a>
                    <a href="{{ route('register') }}" class="btn btn-medieval-outline">Bergabung</a>
                @endauth
            </div>
        </div>
    </div>
</header>

<section class="section-medieval py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width:700px"><p class="eyebrow" style="color:#651d32">Kitab & Kehormatan</p><h2 class="chapter-title">Layanan Sang Perpustakaan</h2><div class="ornament text-warning">◆ ◆ ◆</div></div>
        <div class="row g-4">
            <div class="col-md-4"><div class="card chapter-card h-100"><div class="card-body p-4"><div class="chapter-number">I</div><h3 class="h5 chapter-title">Katalog Naskah</h3><p class="text-muted mb-0">Telusuri judul, penulis, penerbit, dan tahun penerbitan koleksi kerajaan.</p></div></div></div>
            <div class="col-md-4"><div class="card chapter-card h-100"><div class="card-body p-4"><div class="chapter-number">II</div><h3 class="h5 chapter-title">Akses Bergengsi</h3><p class="text-muted mb-0">Hak Admin, Dosen, dan Mahasiswa dilindungi berdasarkan peran masing-masing.</p></div></div></div>
            <div class="col-md-4"><div class="card chapter-card h-100"><div class="card-body p-4"><div class="chapter-number">III</div><h3 class="h5 chapter-title">Pengelolaan Arsip</h3><p class="text-muted mb-0">Pengurus dapat mencatat, memperbarui, dan menjaga koleksi buku dengan tertib.</p></div></div></div>
        </div>
    </div>
</section>

<footer class="py-4"><div class="container text-center"><strong style="color:#651d32">Perpustakaan Kerajaan</strong> &copy; {{ date('Y') }} &mdash; Khazanah Ilmu Abadi</div></footer>
</body>
</html>
