<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vouchers')->insert([
            [
                'code' => 'VELORA-DEMO-100',
                'discount_type' => 'percent',
                'discount_value' => 100,       // 100% gratis
                'max_uses' => 50,
                'used_count' => 0,
                'expires_at' => now()->addMonths(3),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'VELORA-DEMO-50',
                'discount_type' => 'fixed',
                'discount_value' => 50000,     // potong Rp50.000
                'max_uses' => 100,
                'used_count' => 0,
                'expires_at' => now()->addMonths(3),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}