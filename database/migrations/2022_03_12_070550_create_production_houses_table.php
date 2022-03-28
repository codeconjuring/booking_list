<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_houses', function (Blueprint $table) {
            $table->id();
            $table->text('house')->nullable();
            $table->string('nation')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('director')->nullable();
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
        Schema::dropIfExists('production_houses');
    }
}
