<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BookAuthor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_authors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('books_id');
            $table->foreign('books_id')->references('id')->on('books')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedInteger('authors_id');
            $table->foreign('authors_id')->references('id')->on('authors')->cascadeOnUpdate();
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
        Schema::dropIfExists('books_authors');
    }
}
