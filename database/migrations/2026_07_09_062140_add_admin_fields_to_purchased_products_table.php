<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('purchased_products', function (Blueprint $table) {
            $table->string('tracking_id')->nullable()->after('payment_status');
            $table->text('remark')->nullable()->after('tracking_id');
            $table->boolean('is_approved')->default(false)->after('remark');
            $table->timestamp('approved_at')->nullable()->after('is_approved');
            $table->unsignedBigInteger('approved_by')->nullable()->after('approved_at');
        });
    }

    public function down(): void
    {
        Schema::table('purchased_products', function (Blueprint $table) {
            $table->dropColumn(['tracking_id', 'remark', 'is_approved', 'approved_at', 'approved_by']);
        });
    }
};
