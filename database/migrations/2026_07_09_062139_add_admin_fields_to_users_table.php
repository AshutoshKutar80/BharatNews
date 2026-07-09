<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // status already exists (pending / approved / rejected / blocked)
            $table->text('admin_remark')->nullable()->after('status');
            $table->timestamp('status_updated_at')->nullable()->after('admin_remark');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['admin_remark', 'status_updated_at']);
        });
    }
};
