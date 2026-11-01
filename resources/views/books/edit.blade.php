<x-app-layout>
    <h1 class="h3 mb-3">Edit Buku</h1>
    <div class="card shadow-sm border-0"><div class="card-body"><form method="POST" action="{{ route('books.update', $book) }}">
        @csrf @method('PUT')
        @include('books.form', ['book' => $book])
        <button class="btn btn-primary">Perbarui</button> <a class="btn btn-secondary" href="{{ route('books.index') }}">Batal</a>
    </form></div></div>
</x-app-layout>
