<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_sales', function (Blueprint $table) {
            $table->id();
            $table->text('sale_title')->nullable();
            $table->timestamp('sale_date')->nullable();
            $table->text('attachment')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
        Schema::create('book_other_sales', function (Blueprint $table) {
            $table->unsignedBigInteger('other_sales_id');
            $table->foreign('other_sales_id')->references('id')->on('other_sale')->onDelete('cascade');
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->primary(['other_sales_id','book_id']);
            $table->bigInteger('count')->default(0);
            $table->text('total_amount')->default(0);
            $table->boolean('minus_stock')->default(0);
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
        Schema::dropIfExists('book_other_sale');
        Schema::dropIfExists('other_sale');
    }
}
