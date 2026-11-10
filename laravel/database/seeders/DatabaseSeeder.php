<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // User::create(['name' => 'Admin', 'email' => 'admin@test.com', 'password' => 'password', 'role' => 'admin']);
        // User::create(['name' => 'Misbah', 'email' => 'siswa@test.com', 'password' => '12345678', 'role' => 'siswa', 'kelas' => 'XII RPL 2']);

        Buku::create(['Judul' => 'Buku Matematika', 'Penulis' => 'Dr.Tirta', 'Penerbit' => 'Malaka', 'tahun' => 2025, 'stok' => 4]);
        Buku::create(['Judul' => 'Bumi', 'Penulis' => 'Tere Liye', 'Penerbit' => 'Gramedia', 'tahun' => 2014, 'stok' => 3]);
       
    }
}
