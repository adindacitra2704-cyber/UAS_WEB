<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat 20 User Dummy (Sesuai soal)
        User::factory(20)->create();

        // 2. JANGAN GUNAKAN KODE DI BAWAH INI (Hapus atau Komentari)
        // Karena kode ini memaksa input 'name', padahal kolom name tidak ada.
        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
    }
}