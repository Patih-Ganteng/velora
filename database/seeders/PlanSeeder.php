<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // <-- Tambahan untuk matiin relasi

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Matikan satpam relasi database sementara
        Schema::disableForeignKeyConstraints();

        // 2. Kosongkan tabel plans
        DB::table('plans')->truncate();

        // 3. Nyalakan lagi satpamnya
        Schema::enableForeignKeyConstraints();

        // 4. Masukkan data paket yang baru
        DB::table('plans')->insert([
            [
                'id' => 1,
                'name' => 'Gratis',
                'slug' => 'gratis',
                'price' => 0,
                'features' => json_encode([
                    'Maksimal 1 Undangan',
                    'Tema: Mewah, KPop, Anak-anak, Formal',
                    'Tanpa Custom Musik',
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Premium',
                'slug' => 'premium',
                'price' => 69000,
                'features' => json_encode([
                    'Upgrade Undangan Premium',
                    'Undangan Aktif Selamanya',
                    'Unlimited Kuota Tamu',
                    'Semua Tema Premium',
                    'Foto & Video Gallery',
                    'Ucapan & Doa',
                    'Link Streaming',
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Business',
                'slug' => 'business',
                'price' => 99000,
                'features' => json_encode([
                    'Upgrade Premium + 1 Undangan',
                    'Undangan Aktif Selamanya',
                    'Unlimited Kuota Tamu',
                    'Semua Tema Premium',
                    'Foto & Video Gallery',
                    'Ucapan & Doa',
                    'Link Streaming',
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Enterprise',
                'slug' => 'enterprise',
                'price' => 240000,
                'features' => json_encode([
                    'Upgrade Premium + 4 Undangan',
                    'Undangan Aktif Selamanya',
                    'Unlimited Kuota Tamu',
                    'Semua Tema Premium',
                    'Foto & Video Gallery',
                    'Ucapan & Doa',
                    'Link Streaming',
                ]),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}