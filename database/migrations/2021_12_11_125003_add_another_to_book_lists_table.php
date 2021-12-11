<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnotherToBookListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_lists', function (Blueprint $table) {
            $table->integer('add_another_book_translation')->default(0)->comment('0 show another title 1 not showing another column')->after('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_lists', function (Blueprint $table) {
            $table->dropColumn('add_another_book_translation');
        });
    }
}
