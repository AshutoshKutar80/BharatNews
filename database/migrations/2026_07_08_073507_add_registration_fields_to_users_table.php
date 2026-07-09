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
        Schema::table('users', function (Blueprint $table) {

            $table->string('mobile', 10)->unique()->after('email');
            $table->string('state')->nullable()->after('mobile');
            $table->string('district')->nullable()->after('state');
            $table->string('tehsil')->nullable()->after('district');
            $table->string('city')->nullable()->after('tehsil');
            $table->string('pincode', 6)->nullable()->after('city');
            $table->string('role')->default('user')->after('pincode');

            $table->enum('status', ['pending', 'approved', 'reject', 'blocked'])
                ->default('pending')
                ->after('pincode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'mobile',
                'state',
                'district',
                'tehsil',
                'city',
                'pincode',
                'role',
                'status',
            ]);
        });
    }
};
