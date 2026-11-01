<x-guest-layout>
    <!-- Catatan login: form dipasang sebagai gerbang autentikasi dengan validasi Breeze tetap dipertahankan. -->
    <div class="text-center mb-4">
        <p class="text-uppercase mb-1" style="color:#651d32;letter-spacing:.16em;font-family:system-ui,sans-serif;font-size:.75rem;font-weight:800">Gerbang Anggota</p>
        <h1 class="h3 mb-0" style="color:#172f4c;font-family:'Palatino Linotype',Georgia,serif">Masuk ke Perpustakaan</h1>
        <div class="mt-2" style="color:#d8ad48">◆ ◆ ◆</div>
    </div>

    @if(session('status'))<div class="alert alert-success border-0" style="background:#e8eddf;color:#4f6631">{{ session('status') }}</div>@endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="email">Alamat Email</label>
            <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" placeholder="nama@perpustakaan.id" required autofocus autocomplete="username">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Kata Sandi</label>
            <input class="form-control" id="password" type="password" name="password" placeholder="Masukkan kata sandi" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check"><input class="form-check-input" id="remember" type="checkbox" name="remember"><label class="form-check-label small" for="remember">Ingat saya</label></div>
            @if (Route::has('password.request'))<a class="small auth-link" href="{{ route('password.request') }}">Lupa kata sandi?</a>@endif
        </div>
        <button class="btn btn-royal w-100" type="submit">Masuk ke Istana</button>
        <div class="text-center mt-4 small text-muted">Belum memiliki surat akses? <a class="auth-link" href="{{ route('register') }}">Daftar sebagai Mahasiswa</a></div>
    </form>
</x-guest-layout>
