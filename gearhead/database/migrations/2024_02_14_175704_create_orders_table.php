<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_method')->default('stripe'); // Payment method (stripe or cod)
            $table->string('status')->default('pending'); // Order status (pending, paid, delivered, etc.)
            $table->text('product_names'); // Column to store product names
            $table->text('product_images'); // Column to store product image paths
            $table->timestamps();

            // Define foreign key relationship
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
