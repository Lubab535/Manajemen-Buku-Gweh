<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Catatan: Seeder membuat tiga role dan akun demo beserta data role masing-masing.
        foreach (['Admin', 'Dosen', 'Mahasiswa'] as $role) {
            \Spatie\Permission\Models\Role::findOrCreate($role);
        }

        $accounts = [
            ['Admin', 'admin@mbg.test', 'Admin Utama'],
            ['Dosen', 'dosen@mbg.test', 'Dosen Pengajar'],
            ['Mahasiswa', 'mahasiswa@mbg.test', 'Mahasiswa Aktif'],
        ];

        foreach ($accounts as [$role, $email, $name]) {
            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => $name, 'password' => 'password']
            );
            $user->syncRoles([$role]);
        }

        \App\Models\Book::query()->firstOrCreate([
            'title' => 'Pemrograman Laravel Modern',
        ], [
            'author' => 'Tim Pengembang Laravel',
            'publisher' => 'Penerbit Teknik',
            'publication_year' => 2026,
            'description' => 'Pengenalan aplikasi web modern menggunakan Laravel dan Spatie Permission.',
        ]);
    }
}
