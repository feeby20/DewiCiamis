<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'desa_id')) {
                $table->foreignId('desa_id')->nullable()->after('destination_name')->constrained('desa_wisata')->nullOnDelete();
            }
            if (!Schema::hasColumn('orders', 'ticket_status')) {
                $table->enum('ticket_status', ['active', 'used', 'expired'])->default('active')->after('payment_proof');
            }
            if (!Schema::hasColumn('orders', 'validated_at')) {
                $table->timestamp('validated_at')->nullable()->after('ticket_status');
            }
            if (!Schema::hasColumn('orders', 'validated_by')) {
                $table->foreignId('validated_by')->nullable()->after('validated_at')->constrained('pengelola_desa')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'desa_id')) {
                $table->dropForeign(['desa_id']);
                $table->dropColumn('desa_id');
            }
            if (Schema::hasColumn('orders', 'validated_by')) {
                $table->dropForeign(['validated_by']);
                $table->dropColumn('validated_by');
            }
            if (Schema::hasColumn('orders', 'ticket_status')) {
                $table->dropColumn('ticket_status');
            }
            if (Schema::hasColumn('orders', 'validated_at')) {
                $table->dropColumn('validated_at');
            }
        });
    }
};
