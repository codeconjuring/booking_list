<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookListCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_list_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_list_id');
            $table->unsignedBigInteger('cat_id');

            $table->foreign('book_list_id')->references('id')->on('book_lists')->onDelete('cascade');
            $table->foreign('cat_id')->references('id')->on('cats')->onDelete('cascade');
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
        Schema::dropIfExists('book_list_categories');
    }
}
