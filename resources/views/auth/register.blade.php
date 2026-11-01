<x-guest-layout>
    <h4 class="mb-3">Registrasi Mahasiswa</h4>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3"><label class="form-label">Nama</label><input class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus><x-input-error :messages="$errors->get('name')" /></div>
        <div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="{{ old('email') }}" required><x-input-error :messages="$errors->get('email')" /></div>
        <div class="mb-3"><label class="form-label">Password</label><input class="form-control" type="password" name="password" required><x-input-error :messages="$errors->get('password')" /></div>
        <div class="mb-3"><label class="form-label">Konfirmasi Password</label><input class="form-control" type="password" name="password_confirmation" required></div>
        <button class="btn btn-primary w-100" type="submit">Daftar sebagai Mahasiswa</button>
        <div class="text-center mt-3"><a href="{{ route('login') }}">Sudah punya akun? Masuk</a></div>
    </form>
</x-guest-layout>
