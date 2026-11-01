<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Daftar Buku</h1>
        @role('Admin|Dosen')<a href="{{ route('books.create') }}" class="btn btn-primary">Tambah Buku</a>@endrole
    </div>
    <div class="card shadow-sm border-0"><div class="table-responsive"><table class="table table-striped mb-0 align-middle"><thead><tr><th>Judul</th><th>Penulis</th><th>Penerbit</th><th>Tahun</th><th class="text-end">Aksi</th></tr></thead><tbody>
    @forelse($books as $book)
        <tr><td>{{ $book->title }}</td><td>{{ $book->author }}</td><td>{{ $book->publisher ?? '-' }}</td><td>{{ $book->publication_year ?? '-' }}</td><td class="text-end"><a class="btn btn-sm btn-outline-secondary" href="{{ route('books.show', $book) }}">Lihat</a>@role('Admin|Dosen') <a class="btn btn-sm btn-warning" href="{{ route('books.edit', $book) }}">Edit</a>@endrole @role('Admin')<form class="d-inline" method="POST" action="{{ route('books.destroy', $book) }}" onsubmit="return confirm('Hapus buku ini?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>@endrole</td></tr>
    @empty<tr><td colspan="5" class="text-center text-muted py-4">Belum ada buku.</td></tr>@endforelse
    </tbody></table></div></div><div class="mt-3">{{ $books->links() }}</div>
</x-app-layout>
