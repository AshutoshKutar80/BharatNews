<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('temp_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('session_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('product_type');
            $table->decimal('amount', 10, 2);
            $table->string('txn_ref')->unique();
            $table->string('order_id')->nullable();
            $table->string('payment_session_id')->nullable();
            $table->string('status')->default('initiated');
            $table->json('payment_data')->nullable();
            $table->json('raw_response')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->index(['session_id', 'status']);
            $table->index('txn_ref');
        });
    }

    public function down()
    {
        Schema::dropIfExists('temp_payments');
    }
};
