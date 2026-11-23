<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pengelola_desa')) {
            Schema::create('pengelola_desa', function (Blueprint $table) {
                $table->id();
                $table->foreignId('desa_id')->constrained('desa_wisata')->onDelete('cascade');
                $table->string('name', 100);
                $table->string('username', 60)->unique();
                $table->string('email', 100)->unique();
                $table->string('password', 255);
                $table->string('no_hp', 30)->nullable();
                $table->boolean('is_active')->default(true);
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pengelola_desa');
    }
};
