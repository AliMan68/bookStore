<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('discount_percent');
            $table->unsignedInteger('page_count');
            $table->string('editor')->nullable();
            $table->string('isbn')->nullable();
            $table->string('attachment')->nullable();
            $table->string('credits')->nullable();
            $table->string('published')->nullable();
            $table->string('publication_frost')->nullable();
            $table->string('cut')->nullable();
            $table->string('cover')->nullable();
            $table->text('about')->nullable();
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
        Schema::dropIfExists('books');
    }
}
