<x-app-layout>
    <div class="card shadow-sm border-0"><div class="card-body">
        <h1 class="h3">{{ $book->title }}</h1><p class="text-muted">oleh {{ $book->author }}</p>
        <dl class="row"><dt class="col-sm-3">Penerbit</dt><dd class="col-sm-9">{{ $book->publisher ?? '-' }}</dd><dt class="col-sm-3">Tahun Terbit</dt><dd class="col-sm-9">{{ $book->publication_year ?? '-' }}</dd><dt class="col-sm-3">Deskripsi</dt><dd class="col-sm-9">{{ $book->description ?? '-' }}</dd></dl>
        @role('Admin|Dosen')<a class="btn btn-warning" href="{{ route('books.edit', $book) }}">Edit</a>@endrole <a class="btn btn-secondary" href="{{ route('books.index') }}">Kembali</a>
    </div></div>
</x-app-layout>
