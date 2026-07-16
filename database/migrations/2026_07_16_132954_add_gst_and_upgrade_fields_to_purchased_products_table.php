<?php
// database/migrations/xxxx_xx_xx_add_gst_and_upgrade_fields_to_purchased_products_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('purchased_products', function (Blueprint $table) {
            $table->decimal('gst_amount', 10, 2)->default(0)->after('amount');
            $table->decimal('total_amount', 10, 2)->default(0)->after('gst_amount');
            $table->boolean('is_upgrade')->default(false)->after('payment_status');
            $table->unsignedBigInteger('upgraded_from')->nullable()->after('is_upgrade');
            $table->boolean('is_upgraded')->default(false)->after('upgraded_from');
            $table->text('admin_remark')->nullable()->after('upgraded_from');
        });
    }

    public function down(): void
    {
        Schema::table('purchased_products', function (Blueprint $table) {
            $table->dropColumn(['gst_amount', 'total_amount', 'is_upgrade', 'upgraded_from', 'is_upgraded', 'admin_remark']);
        });
    }
};
