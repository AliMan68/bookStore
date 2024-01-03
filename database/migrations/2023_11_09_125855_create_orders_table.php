<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('price');
            $table->enum('status',['completed','unpaid','canceled','else']);
            $table->string('receiver_name');
            $table->string('receiver_number');
            $table->string('receiver_state')->nullable();
            $table->string('receiver_city')->nullable();
            $table->string('receiver_postal_code')->nullable();
            $table->text('receiver_address')->nullable();
            $table->enum('delivery_type',['in_post','in_person']);
            $table->text('tracking_code')->nullable();
            $table->unsignedBigInteger('discount_code_id')->nullable();
            $table->foreign('discount_code_id')->references('code')->on('discount_codes')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('book_order', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('price');
            $table->primary(['order_id','book_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_order');
        Schema::dropIfExists('orders');
    }
}
