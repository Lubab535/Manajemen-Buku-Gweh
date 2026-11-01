<x-guest-layout>
    <h4 class="mb-3">Masuk</h4>
    @if(session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3"><label class="form-label" for="email">Email</label><input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus><x-input-error :messages="$errors->get('email')" class="mt-2" /></div>
        <div class="mb-3"><label class="form-label" for="password">Password</label><input class="form-control" id="password" type="password" name="password" required><x-input-error :messages="$errors->get('password')" class="mt-2" /></div>
        <div class="form-check mb-3"><input class="form-check-input" id="remember" type="checkbox" name="remember"><label class="form-check-label" for="remember">Ingat saya</label></div>
        <button class="btn btn-primary w-100" type="submit">Masuk</button>
        <div class="text-center mt-3"><a href="{{ route('register') }}">Belum punya akun? Daftar</a></div>
    </form>
</x-guest-layout>
