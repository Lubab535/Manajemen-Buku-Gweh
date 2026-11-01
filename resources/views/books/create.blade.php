<x-app-layout>
    <h1 class="h3 mb-3">Tambah Buku</h1>
    <div class="card shadow-sm border-0"><div class="card-body"><form method="POST" action="{{ route('books.store') }}">
        @csrf
        @include('books.form', ['book' => null])
        <button class="btn btn-primary">Simpan</button> <a class="btn btn-secondary" href="{{ route('books.index') }}">Batal</a>
    </form></div></div>
</x-app-layout>
