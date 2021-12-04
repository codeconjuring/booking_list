<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookListTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_list_titles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_list_id');
            $table->string('title')->nullable();
            $table->integer('parent')->default(1)->comment('parent title=1,child title=0');
            $table->integer('parent_id')->nullable();

            $table->foreign('book_list_id')->references('id')->on('book_lists')->onDelete('cascade');
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
        Schema::dropIfExists('book_list_titles');
    }
}
