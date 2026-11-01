<x-app-layout><h1 class="h3 mb-3">Edit Pengguna</h1><div class="card shadow-sm border-0"><div class="card-body"><form method="POST" action="{{ route('users.update', $user) }}">@csrf @method('PUT')
@include('users.form', ['user' => $user])<button class="btn btn-primary">Perbarui</button> <a class="btn btn-secondary" href="{{ route('users.index') }}">Batal</a></form></div></div></x-app-layout>
