<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublishRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publish_request', function (Blueprint $table) {
            $table->id();
            $table->text('request_number')->nullable();
            $table->timestamp('request_date')->nullable();
            $table->text('attachment')->nullable();
            $table->text('total_amount')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('book_publishment_request', function (Blueprint $table) {
            $table->unsignedBigInteger('publishment_request_id');
            $table->foreign('request_id')->references('id')->on('publish_request')->onDelete('cascade');
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->primary(['request_id','book_id']);
            $table->bigInteger('count')->default(0);
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

        Schema::dropIfExists('book_publish_request');
        Schema::dropIfExists('publish_request');
    }
}
