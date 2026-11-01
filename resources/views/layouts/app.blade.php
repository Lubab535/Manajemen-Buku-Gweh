<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Manajemen Buku') }}</title>
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <style>
        :root{--medieval-navy:#172f4c;--medieval-burgundy:#651d32;--medieval-gold:#d8ad48;--medieval-parchment:#f4edda}
        body{background:var(--medieval-parchment);color:#322d27;background-image:radial-gradient(rgba(101,29,50,.06) 1px,transparent 1px);background-size:7px 7px;font-family:Georgia,'Times New Roman',serif}
        .library-navbar{background:linear-gradient(90deg,#101f33,var(--medieval-navy)) !important;border-bottom:4px solid var(--medieval-gold);box-shadow:0 4px 18px rgba(16,31,51,.28)}
        .library-navbar .navbar-brand{font-family:'Palatino Linotype',Georgia,serif;letter-spacing:.04em}
        .library-navbar .nav-link{color:#e9dfc5!important;margin:0 .12rem;border-bottom:2px solid transparent;font-family:system-ui,sans-serif}
        .library-navbar .nav-link:hover,.library-navbar .nav-link.active{color:var(--medieval-gold)!important;border-bottom-color:var(--medieval-gold)}
        .library-card{border:1px solid rgba(101,29,50,.16)!important;border-radius:4px!important;box-shadow:0 12px 28px rgba(101,29,50,.09)!important;background:rgba(255,252,244,.96)}
        .btn-library{background:var(--medieval-gold);border:1px solid #9c792c;color:#2d2310;font-weight:700;border-radius:2px}
        .btn-library:hover{background:#e4c269;border-color:#b28a34;color:#21190d}
        footer{background:#ede1c4;border-top:1px solid #d6c59c!important;color:#695d48}
        .text-primary{color:var(--medieval-burgundy)!important}.btn-outline-primary{color:var(--medieval-burgundy);border-color:var(--medieval-burgundy)}.btn-outline-primary:hover{background:var(--medieval-burgundy);border-color:var(--medieval-burgundy)}
        /* Catatan: gaya buku abad pertengahan diterapkan konsisten pada semua halaman yang memakai layout ini. */
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg navbar-dark library-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Manajemen Buku</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('books.index') }}">Buku</a></li>
                @role('Admin')
                    <li class="nav-item"><a class="nav-link" href="{{ route('users.index') }}">Pengguna</a></li>
                @endrole
            </ul>
            <div class="d-flex align-items-center gap-2 text-white">
                <span class="small">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn btn-outline-light btn-sm">Logout</button></form>
            </div>
        </div>
    </div>
</nav>
<main class="container py-4 flex-grow-1">
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
    {{ $slot }}
</main>
<footer class="bg-light border-top py-3 mt-auto"><div class="container text-center text-muted small">Manajemen Buku &copy; {{ date('Y') }}</div></footer>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
</body>
</html>
