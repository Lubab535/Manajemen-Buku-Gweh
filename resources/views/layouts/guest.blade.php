<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Manajemen Buku') }}</title>
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="text-center mb-4"><a class="text-decoration-none h3 fw-bold text-dark" href="/">Manajemen Buku</a></div>
                <div class="card shadow-sm border-0"><div class="card-body p-4">{{ $slot }}</div></div>
            </div>
        </div>
    </main>
</body>
</html>
