<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_departments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('production_house_id');
            $table->string('production_year')->nullable();
            $table->string('production_month')->nullable();
            $table->string('stat_type')->comment('1=books,2=tracts')->nullable();
            $table->float('total_cost', 10, 2)->nullable();
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
        Schema::dropIfExists('production_departments');
    }
}
