<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpectationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expectations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('expectation')->nullable();
            $table->string('bus_qty')->nullable();
            $table->integer('bus_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->date('date')->nullable();
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
        Schema::dropIfExists('expectations');
    }
}
