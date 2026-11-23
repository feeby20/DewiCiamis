<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('desa_wisata')) {
            Schema::create('desa_wisata', function (Blueprint $table) {
                $table->id();
                $table->string('nama_desa', 100);
                $table->string('slug', 120)->unique();
                $table->string('kecamatan', 100);
                $table->string('sk_bupati', 100)->nullable();
                $table->string('status_desa', 50)->default('Rintisan'); // Rintisan, Berkembang, Maju, Mandiri
                $table->string('kategori', 50)->default('Alam'); // Alam, Buatan, Sejarah & Budaya
                $table->string('destinasi_unggulan', 150)->nullable();
                $table->text('deskripsi')->nullable();
                $table->string('gambar', 255)->nullable();
                $table->string('jam_buka', 100)->default('08:00 - 17:00 WIB');
                $table->string('hari_operasional', 100)->default('Setiap Hari');
                $table->decimal('harga_tiket', 12, 2)->default(5000);
                
                // Informasi Rekening Kas / BUMDes Desa
                $table->string('nama_bank', 50)->nullable();
                $table->string('nomor_rekening', 50)->nullable();
                $table->string('atas_nama_rekening', 100)->nullable();

                // Akumulasi Keuangan Desa
                $table->decimal('saldo_tersedia', 14, 2)->default(0);
                $table->decimal('saldo_dicairkan', 14, 2)->default(0);

                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('desa_wisata');
    }
};
