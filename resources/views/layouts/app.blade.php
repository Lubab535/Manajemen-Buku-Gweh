<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Manajemen Buku') }}</title>
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
