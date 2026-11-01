<x-app-layout>
    <div class="d-flex justify-content-between align-items-center mb-3"><h1 class="h3 mb-0">Kelola Pengguna</h1><a class="btn btn-primary" href="{{ route('users.create') }}">Tambah Pengguna</a></div>
    <div class="card shadow-sm border-0"><div class="table-responsive"><table class="table table-striped mb-0"><thead><tr><th>Nama</th><th>Email</th><th>Role</th><th class="text-end">Aksi</th></tr></thead><tbody>
    @forelse($users as $user)<tr><td>{{ $user->name }}</td><td>{{ $user->email }}</td><td>{{ $user->roles->pluck('name')->join(', ') ?: '-' }}</td><td class="text-end"><a class="btn btn-sm btn-warning" href="{{ route('users.edit', $user) }}">Edit</a>@if(auth()->id() !== $user->id)<form class="d-inline" method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Hapus pengguna ini?')">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>@endif</td></tr>@empty<tr><td colspan="4" class="text-center py-4">Belum ada pengguna.</td></tr>@endforelse
    </tbody></table></div></div><div class="mt-3">{{ $users->links() }}</div>
</x-app-layout>
