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
            $table->string('payment_method');
            $table->integer('user_id');
            $table->integer('cart_id')->nullable();
            $table->string('state')->default('new');
            $table->boolean('is_ordered')->default(0);
            $table->float('order_total')->defualt(0.0);
            $table->float('tax')->defualt(0.0);
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
