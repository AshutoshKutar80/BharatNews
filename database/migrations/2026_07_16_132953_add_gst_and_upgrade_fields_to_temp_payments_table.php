<?php
// database/migrations/xxxx_xx_xx_add_gst_and_upgrade_fields_to_temp_payments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('temp_payments', function (Blueprint $table) {
            $table->decimal('gst_amount', 10, 2)->default(0)->after('amount');
            $table->decimal('total_amount', 10, 2)->default(0)->after('gst_amount');
            $table->boolean('is_upgrade')->default(false)->after('status');
            $table->unsignedBigInteger('upgraded_from')->nullable()->after('is_upgrade');
        });
    }

    public function down(): void
    {
        Schema::table('temp_payments', function (Blueprint $table) {
            $table->dropColumn(['gst_amount', 'total_amount', 'is_upgrade', 'upgraded_from']);
        });
    }
};
