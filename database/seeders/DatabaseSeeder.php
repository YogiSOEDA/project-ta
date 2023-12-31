<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Barang::factory(50)->create();

        // Barang::create([
        //     'nama_barang' => 'Plastik Sampah',
        //     'harga' => '2000',
        //     'gambar' => 'https://via.placeholder.com/640x480.png/004466?text=animals+omnis',
        // ]);
    }
}
