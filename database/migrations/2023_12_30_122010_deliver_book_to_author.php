<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeliverBookToAuthor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('authors', function (Blueprint $table) {
            Schema::create('deliver', function (Blueprint $table) {
                $table->id();
                $table->text('transferee')->nullable();
                $table->timestamp('deliver_date')->nullable();
                $table->text('attachment')->nullable();
                $table->timestamps();
                $table->softDeletes();

            });

            Schema::create('book_delivers', function (Blueprint $table) {
                $table->unsignedBigInteger('deliver_id');
                $table->foreign('deliver_id')->references('id')->on('delivers')->onDelete('cascade');
                $table->unsignedBigInteger('book_id');
                $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
                $table->primary(['deliver_id','book_id']);
                $table->bigInteger('count')->default(0);
                $table->boolean('minus_stock')->default(0);
                $table->timestamps();
                $table->softDeletes();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('author', function (Blueprint $table) {
            $table->drop('book_delivers');
            $table->drop('authors');
        });
    }
}
