<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        DB::table('divisis')->insert([
            'nama_divisi' => "HRD"
        ]);
        DB::table('divisis')->insert([
            'nama_divisi' => "Manager"
        ]);
        DB::table('divisis')->insert([
            'nama_divisi' => "IT"
        ]);

        DB::table('kompetensis')->insert([
            'kompetensi' => "Kehadiran"
        ]);
        DB::table('kompetensis')->insert([
            'kompetensi' => "Tugas Selesai"
        ]);
        DB::table('kompetensis')->insert([
            'kompetensi' => "Kedisiplinan"
        ]);
        DB::table('kompetensis')->insert([
            'kompetensi' => "Kinerja"
        ]);
        DB::table('kompetensis')->insert([
            'kompetensi' => "Keterampilan"
        ]);

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => Hash::make('12345678'),
        ]);
    }
}
