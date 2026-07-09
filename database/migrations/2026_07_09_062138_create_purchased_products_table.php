<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchased_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('product_type');
            $table->string('product_name')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('txn_ref')->unique();
            $table->string('order_id')->nullable();
            $table->string('payment_status')->default('success'); // record only created on success
            $table->timestamp('purchased_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'product_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchased_products');
    }
};
