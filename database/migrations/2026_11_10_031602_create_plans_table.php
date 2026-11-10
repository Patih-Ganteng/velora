<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');                 // Gratis, Bisnis, Enterprise
            $table->string('slug')->unique();       // gratis, bisnis, enterprise
            $table->unsignedInteger('price')->default(0); // harga dalam rupiah
            $table->json('features')->nullable();   // daftar fitur
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};