<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("book_list_id");
            $table->text("cover_file_name")->nullable();
            $table->text("epub_file_name")->nullable();
            $table->text("audio_file_name")->nullable();
            $table->string("narrator_id")->nullable();
            $table->string("pages")->nullable();
            $table->string("to_read")->nullable();
            $table->string("to_listen")->nullable();
            $table->text("synopsis")->nullable();
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
        Schema::dropIfExists('book_infos');
    }
}
