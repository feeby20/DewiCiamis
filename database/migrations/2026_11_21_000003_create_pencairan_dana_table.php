<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pencairan_dana')) {
            Schema::create('pencairan_dana', function (Blueprint $table) {
                $table->id();
                $table->string('kode_pencairan', 60)->unique();
                $table->foreignId('desa_id')->constrained('desa_wisata')->onDelete('cascade');
                $table->foreignId('pengelola_id')->constrained('pengelola_desa')->onDelete('cascade');
                $table->decimal('nominal', 14, 2);
                $table->string('bank_tujuan', 50);
                $table->string('nomor_rekening', 50);
                $table->string('atas_nama', 100);
                $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
                $table->string('bukti_transfer', 255)->nullable();
                $table->text('catatan_admin')->nullable();
                $table->timestamp('tanggal_pengajuan')->useCurrent();
                $table->timestamp('tanggal_konfirmasi')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pencairan_dana');
    }
};
