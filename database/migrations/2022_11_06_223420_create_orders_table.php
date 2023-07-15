<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->unsignedInteger('user_id');
            $table->json('user_data');
            $table->string('session_id', 255)->nullable();
            $table->string('status')->default('pending');
            $table->string('payment_status')->default('unpaid');
            $table->double('discount')->nullable();
            $table->string('coupon_code')->nullable();
            $table->json('coupon_data')->nullable();
            $table->double('total_before_discount');
            $table->unsignedFloat('total');
            $table->text('note')->nullable();
            $table->json('form_data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
