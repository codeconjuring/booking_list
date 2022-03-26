<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookFormatInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_format_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_list_id');
            $table->unsignedBigInteger('form_builder_id');
            $table->float('price', 10, 2)->nullable();
            $table->string('modification_year')->nullable();
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
        Schema::dropIfExists('book_format_infos');
    }
}
