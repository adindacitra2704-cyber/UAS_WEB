<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            // Kolom email
            $table->string('email')->unique();
            
            // Kolom password (mewakili hashed_password)
            $table->string('password');
            
            // Kolom reset_token (Sesuai permintaan gambar)
            $table->string('reset_token', 100)->nullable();
            
            // Opsional: rememberToken (bawaan Laravel, bisa dihapus jika ingin 100% persis gambar)
            $table->rememberToken();
            
            // Timestamps (created_at & updated_at)
            $table->timestamps();
        });

        // Tabel password_reset_tokens bawaan (Biarkan saja untuk fitur reset password standar Laravel)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tabel sessions bawaan (Biarkan saja)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};