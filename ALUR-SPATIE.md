# Alur Penggunaan Spatie Permission

Dokumen ini menjelaskan alur penggunaan paket `spatie/laravel-permission` pada aplikasi Manajemen Buku Gweh.

## Ringkasan Konfigurasi

Aplikasi menggunakan **Laravel Permission versi 8.3.2** untuk pengelolaan role:

- Model pengguna: `App\Models\User`
- Trait role: `Spatie\Permission\Traits\HasRoles`
- Role yang tersedia: `Admin`, `Dosen`, dan `Mahasiswa`
- Model role: `Spatie\Permission\Models\Role`
- Guard: `web`
- Laravel Blade directive: `@role(...)` dan `@endrole`
- Middleware route: `role:NamaRole`

Package ini belum digunakan untuk permission individual dalam aplikasi. Pemeriksaan akses saat ini sepenuhnya berbasis role.

## Struktur Database

Migration Spatie membuat tabel berikut:

| Tabel | Fungsi |
|---|---|
| `roles` | Menyimpan daftar role beserta `guard_name` |
| `permissions` | Menyimpan daftar permission individual |
| `model_has_roles` | Menghubungkan role dengan model, dalam aplikasi ini pengguna pada tabel `users` |
| `model_has_permissions` | Menghubungkan permission langsung kepada model pengguna |
| `role_has_permissions` | Menghubungkan permission kepada role |

Alur relasi role pengguna adalah:

```text
users
  |
  | model_has_roles
  v
roles -> role_has_permissions -> permissions
```

Dalam aplikasi saat ini, tabel `permissions` dan `role_has_permissions` tersedia, tetapi belum menjadi sumber keputusan akses utama.

## Pemasangan pada Model User

Model `App\Models\User` menggunakan trait `HasRoles`:

```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;
}
```

Trait ini menambahkan relasi role dan method seperti:

- `$user->assignRole('Admin')`
- `$user->syncRoles(['Dosen'])`
- `$user->hasRole('Admin')`
- `$user->hasAnyRole(['Admin', 'Dosen'])`
- `$user->removeRole('Mahasiswa')`

## Pembuatan Role Awal

Role dibuat oleh `DatabaseSeeder`:

```php
foreach (['Admin', 'Dosen', 'Mahasiswa'] as $role) {
    Role::findOrCreate($role);
}
```

Setelah role dibuat, seeder membuat tiga akun demo dan menjalankan `syncRoles()`:

| Email | Role |
|---|---|
| `admin@mbg.test` | `Admin` |
| `dosen@mbg.test` | `Dosen` |
| `mahasiswa@mbg.test` | `Mahasiswa` |

Password demo semuanya adalah `password`.

Perintah untuk membuat tabel dan data awal:

```bash
php artisan migrate
php artisan db:seed
```

Untuk mengulang proses instalasi database dari awal, jika memang diperlukan:

```bash
php artisan migrate:fresh --seed
```

Perintah kedua menghapus seluruh data database sehingga harus digunakan dengan hati-hati.

## Alur Registrasi Pengguna Baru

Alur registrasi ditangani oleh `RegisteredUserController`:

```text
Pengguna membuka halaman register
            |
            v
Form divalidasi
nama, email unik, dan password cocok
            |
            v
Akun dibuat pada tabel users
            |
            v
Role Mahasiswa dicari/dibuat oleh Spatie
            |
            v
assignRole(Mahasiswa) menyimpan relasi di model_has_roles
            |
            v
Pengguna login otomatis
            |
            v
Di arahkan ke dashboard
```

Bagian penting pada controller:

```php
$studentRole = Role::findOrCreate('Mahasiswa', 'web');
$user->assignRole($studentRole);
```

`assignRole()` menambah role tanpa menghapus role lain yang sudah dimiliki pengguna. Registrasi selalu memberikan role `Mahasiswa` kepada akun baru.

## Alur Login dan Pemeriksaan Akses

Setelah autentikasi berhasil, Laravel menyimpan pengguna yang login dalam sesi. Spatie membaca role pengguna dari relasi `model_has_roles`, lalu melakukan pemeriksaan berdasarkan role.

Pemeriksaan dapat terjadi pada dua lapisan:

1. Middleware route untuk membatasi akses URL.
2. Blade directive untuk menyembunyikan atau menampilkan elemen antarmuka.

Middleware dan Blade harus diperlakukan sebagai lapisan UX dan lapisan keamanan route. Middleware adalah pemeriksaan utama terhadap setiap request.

## Pembatasan Route

Konfigurasi akses route berada pada `routes/web.php`.

### Akses Umum

Semua pengguna yang sudah login dapat:

- Melihat daftar buku.
- Melihat detail buku.
- Membuka halaman profil.

Route tersebut dilindungi oleh middleware `auth`.

### Admin dan Dosen

Role `Admin` atau `Dosen` dapat membuka:

- Form tambah buku.
- Penyimpanan buku baru.
- Form edit buku.
- Pembaruan buku.

Route menggunakan middleware Spatie:

```php
Route::middleware('role:Admin|Dosen')->group(function () {
    // Route create dan edit buku
});
```

`Admin|Dosen` berarti setidaknya salah satu role tersebut harus dimiliki pengguna.

### Khusus Admin

Role `Admin` dapat:

- Menghapus buku.
- Mengelola seluruh akun pengguna melalui CRUD user.

Contoh route:

```php
Route::delete('/books/{book}', [BookController::class, 'destroy'])
    ->middleware('role:Admin');
```

## Matriks Akses

| Fitur | Admin | Dosen | Mahasiswa | Belum login |
|---|:---:|:---:|:---:|:---:|
| Dashboard | Ya | Ya | Ya | Tidak |
| Melihat daftar buku | Ya | Ya | Ya | Tidak |
| Melihat detail buku | Ya | Ya | Ya | Tidak |
| Tambah buku | Ya | Ya | Tidak | Tidak |
| Edit buku | Ya | Ya | Tidak | Tidak |
| Hapus buku | Ya | Tidak | Tidak | Tidak |
| CRUD pengguna | Ya | Tidak | Tidak | Tidak |
| Registrasi akun baru | Publik | Publik | Publik | Ya |

## Pengelolaan Role pada CRUD Pengguna

Admin mengelola akun pengguna melalui `UserController`. Validasi role pada `UserRequest` hanya menerima satu dari tiga role berikut:

- `Admin`
- `Dosen`
- `Mahasiswa`

### Saat Menambah Pengguna

```text
Admin membuka form tambah pengguna
            |
            v
UserRequest divalidasi
            |
            v
Akun dibuat pada tabel users
            |
            v
syncRoles([role terpilih])
            |
            v
Relasi lama diganti dengan role baru
```

### Saat Mengubah Pengguna

`UserController::update()` memperbarui data akun lalu menjalankan:

```php
$user->syncRoles([$data['role']]);
```

`syncRoles()` memastikan pengguna hanya menyimpan role yang dipilih pada form. Role lama akan dilepas.

### Saat Menghapus Pengguna

Pengguna tidak dapat menghapus akun yang sedang login. Pemeriksaan dilakukan berdasarkan ID pengguna yang aktif:

```php
if ($user->id === auth()->id()) {
    return back()->with('error', 'Anda tidak dapat menghapus akun yang sedang login.');
}
```

## Penggunaan di Blade

Aplikasi menyembunyikan atau menampilkan kontrol berdasarkan role agar antarmuka sesuai hak akses:

```blade
@role('Admin')
    <a href="{{ route('users.index') }}">Kelola Pengguna</a>
@endrole
```

Beberapa penggunaan dalam aplikasi:

- Tombol **Tambah Buku** dan **Edit** ditampilkan untuk `Admin` atau `Dosen`.
- Tombol **Hapus** ditampilkan hanya untuk `Admin`.
- Menu **Kelola Pengguna** ditampilkan hanya untuk `Admin`.
- Badge role pada dashboard dibedakan untuk `Admin`, `Dosen`, dan `Mahasiswa`.

Contoh gabungan role:

```blade
@role('Admin|Dosen')
    Konten untuk Admin atau Dosen
@endrole
```

Blade directive bersifat presentasi. Akses URL tetap harus dilindungi oleh middleware route.

## Alur Pemeriksaan Role dari Request

Contoh alur penghapusan buku:

```text
Request DELETE /books/{book}
            |
            v
Middleware auth
            |
            v
Apakah pengguna sudah login?
            | Tidak -> redirect login
            | Ya
            v
Middleware role:Admin
            |
            v
Apakah pengguna memiliki role Admin?
            | Tidak -> akses ditolak
            | Ya
            v
BookController::destroy() dijalankan
```

## Cache Role dan Permission

Spatie Permission menggunakan cache untuk mempercepat pemeriksaan role. Cache akan ikut dibersihkan saat menjalankan migration atau perubahan tertentu, tetapi cache juga dapat dibersihkan secara manual jika relasi terasa belum diperbarui:

```bash
php artisan permission:cache-reset
php artisan optimize:clear
```

Untuk pemeriksaan cepat pada kode atau Tinker:

```php
$user = App\Models\User::where('email', 'admin@mbg.test')->first();
$user->hasRole('Admin');
$user->getRoleNames();
```

## Menambah Role Baru

Untuk menambah role baru ke aplikasi:

1. Tambahkan nama role pada seeder jika role harus ada setiap kali database disiapkan.

   ```php
   Role::findOrCreate('Staff', 'web');
   ```

2. Tambahkan role pada validasi `UserRequest` jika role dapat dipilih melalui form pengguna.

   ```php
   'role' => ['required', 'in:Admin,Dosen,Mahasiswa,Staff'],
   ```

3. Tambahkan middleware pada route yang membutuhkan role tersebut.

   ```php
   Route::middleware('role:Staff');
   ```

4. Tambahkan directive Blade bila kontrol perlu disembunyikan atau ditampilkan.

   ```blade
   @role('Staff')
       <!-- Konten khusus Staff -->
   @endrole
   ```

5. Jalankan seeder dan pastikan cache permission dibersihkan jika diperlukan.

## Menambah Permission Individual

Aplikasi saat ini masih berbasis role, tetapi Spatie mendukung permission individual jika akses membutuhkan tingkat detail lebih tinggi.

Contoh permission:

```php
use Spatie\Permission\Models\Permission;

$permission = Permission::findOrCreate('book.delete', 'web');
```

Memberikan permission langsung kepada role:

```php
$admin = Role::findOrCreate('Admin', 'web');
$admin->givePermissionTo('book.delete');
```

Pemeriksaan pada route atau controller:

```php
$user->can('book.delete');
```

Middleware permission:

```php
Route::middleware('permission:book.delete');
```

Gunakan permission bila aturan akses banyak atau bersifat granular. Gunakan role bila logika aplikasi jelas dibagi berdasarkan jenis pengguna.

## Checklist Pengembangan

- [ ] Tambahkan role melalui seeder dengan `Role::findOrCreate()`.
- [ ] Tambahkan `HasRoles` pada model pengguna.
- [ ] Lindungi route mutasi menggunakan middleware `role` atau `permission`.
- [ ] Sinkronkan role pengguna dengan `syncRoles()` bila pengguna hanya boleh memiliki satu role.
- [ ] Gunakan `assignRole()` jika role harus ditambahkan tanpa menghapus role lama.
- [ ] Tambahkan directive Blade hanya untuk menampilkan atau menyembunyikan UI.
- [ ] Jangan mengandalkan Blade directive sebagai satu-satunya pengaman akses.
- [ ] Bersihkan cache role/permission setelah perubahan data yang tidak diperbarui secara normal.
