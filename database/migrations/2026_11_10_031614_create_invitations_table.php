<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('category');     // nikah, ultah, umum
            $table->string('sub_theme');    // kpop, mewah, formal, dll
            $table->string('title');
            $table->dateTime('event_date');
            $table->json('config')->nullable();
            $table->enum('status', ['draft', 'active', 'expired'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};