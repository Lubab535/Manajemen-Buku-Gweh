<x-app-layout>
    <!-- Catatan abad pertengahan: banner bertindak seperti prasasti kerajaan dan kartu ringkasan memakai pola emblem. -->
    <section class="p-4 mb-4 text-white" style="background:linear-gradient(115deg,#651d32,#172f4c);border:2px solid #d8ad48;border-radius:2px;box-shadow:0 8px 24px rgba(65,42,30,.18)">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div><p class="mb-1 text-uppercase" style="color:#d8ad48;letter-spacing:.16em;font-family:system-ui,sans-serif;font-size:.78rem;font-weight:700">Kota Pengetahuan Kerajaan</p><h1 class="h3 mb-1" style="font-family:'Palatino Linotype',Georgia,serif">Selamat datang, {{ auth()->user()->name }}</h1><p class="mb-0 text-white-50">Di perpustakaan kerajaan, setiap lembar menyimpan warisan ilmu.</p></div>
            <div>
                @role('Admin')<span class="badge px-3 py-2" style="background:#d8ad48;color:#3d2b12">ADMIN</span>@elserole('Dosen')<span class="badge px-3 py-2" style="background:#172f4c;border:1px solid #d8ad48">DOSEN</span>@elserole('Mahasiswa')<span class="badge px-3 py-2" style="background:#651d32;border:1px solid #d8ad48">MAHASISWA</span>@endrole
            </div>
        </div>
    </section>

    <div class="row g-4">
        <div class="col-md-6 col-lg-4">
            <div class="card library-card h-100"><div class="card-body p-4"><div class="d-flex justify-content-between"><div><p class="text-muted mb-1" style="font-family:system-ui,sans-serif;font-size:.8rem;text-transform:uppercase">Koleksi Naskah</p><div class="display-5 fw-bold text-primary">{{ $bookCount }}</div></div><div class="rounded-circle d-flex align-items-center justify-content-center" style="width:58px;height:58px;background:#651d32;color:#d8ad48;border:3px double #d8ad48;font-family:Georgia,serif">B</div></div><a href="{{ route('books.index') }}" class="btn btn-library mt-3">Buka katalog</a></div></div>
        </div>
        @role('Admin')
        <div class="col-md-6 col-lg-4">
            <div class="card library-card h-100"><div class="card-body p-4"><div class="d-flex justify-content-between"><div><p class="text-muted mb-1" style="font-family:system-ui,sans-serif;font-size:.8rem;text-transform:uppercase">Para Pengguna</p><div class="display-5 fw-bold text-primary">{{ $userCount }}</div></div><div class="rounded-circle d-flex align-items-center justify-content-center" style="width:58px;height:58px;background:#651d32;color:#d8ad48;border:3px double #d8ad48">U</div></div><a href="{{ route('users.index') }}" class="btn btn-library mt-3">Kelola kesatria</a></div></div>
        </div>
        @endrole
        @role('Admin|Dosen')
        <div class="col-md-6 col-lg-4">
            <div class="card library-card h-100"><div class="card-body p-4"><p class="text-muted mb-1" style="font-family:system-ui,sans-serif;font-size:.8rem;text-transform:uppercase">Gerbang Cepat</p><h2 class="h5 text-primary">Catat Naskah Baru</h2><p class="small text-muted">Tambahkan judul, penulis, penerbit, dan tahun terbit.</p><a href="{{ route('books.create') }}" class="btn btn-outline-primary mt-1">Tambah Buku</a></div></div>
        </div>
        @endrole
    </div>
</x-app-layout>
