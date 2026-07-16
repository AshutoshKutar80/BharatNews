<?php
// database/migrations/xxxx_xx_xx_add_gst_and_upgrade_fields_to_payments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->decimal('gst_amount', 10, 2)->default(0)->after('amount');
            $table->decimal('total_amount', 10, 2)->default(0)->after('gst_amount');
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['gst_amount', 'total_amount']);
        });
    }
};
