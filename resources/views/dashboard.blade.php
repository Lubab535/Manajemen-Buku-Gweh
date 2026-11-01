<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div><h1 class="h3 mb-1">Dashboard</h1><p class="text-muted mb-0">Halo, {{ auth()->user()->name }}</p></div>
        @role('Admin')<span class="badge bg-danger">Admin</span>@elserole('Dosen')<span class="badge bg-primary">Dosen</span>@elserole('Mahasiswa')<span class="badge bg-success">Mahasiswa</span>@endrole
    </div>
    <div class="row g-3">
        <div class="col-md-6"><div class="card shadow-sm border-0"><div class="card-body"><h6 class="text-muted">Total Buku</h6><div class="display-6 fw-bold">{{ $bookCount }}</div><a href="{{ route('books.index') }}" class="btn btn-outline-primary btn-sm mt-2">Lihat Buku</a></div></div></div>
        @role('Admin')<div class="col-md-6"><div class="card shadow-sm border-0"><div class="card-body"><h6 class="text-muted">Total Pengguna</h6><div class="display-6 fw-bold">{{ $userCount }}</div><a href="{{ route('users.index') }}" class="btn btn-outline-primary btn-sm mt-2">Kelola Pengguna</a></div></div></div>@endrole
    </div>
</x-app-layout>
