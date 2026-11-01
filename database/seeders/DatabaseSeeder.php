<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder Spatie: setiap nama berikut menjadi role yang tersimpan pada tabel roles.
        foreach (['Admin', 'Dosen', 'Mahasiswa'] as $role) {
            Role::findOrCreate($role);
        }

        $accounts = [
            ['Admin', 'admin@mbg.test', 'Admin Utama'],
            ['Dosen', 'dosen@mbg.test', 'Dosen Pengajar'],
            ['Mahasiswa', 'mahasiswa@mbg.test', 'Mahasiswa Aktif'],
        ];

        foreach ($accounts as [$role, $email, $name]) {
            // Akun dibuat hanya jika email belum tersedia.
            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => $name, 'password' => 'password']
            );
            // syncRoles() mengganti role lama agar akun mendapat tepat satu role demo yang sesuai.
            $user->syncRoles([$role]);
        }

        Book::query()->firstOrCreate([
            'title' => 'Pemrograman Laravel Modern',
        ], [
            'author' => 'Tim Pengembang Laravel',
            'publisher' => 'Penerbit Teknik',
            'publication_year' => 2026,
            'description' => 'Pengenalan aplikasi web modern menggunakan Laravel dan Spatie Permission.',
        ]);
    }
}
