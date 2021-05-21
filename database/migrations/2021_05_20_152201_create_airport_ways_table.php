<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirportWaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airport_ways', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('airport_id');
            $table->string('number'); 
            $table->string('height');
            $table->string('width');
            $table->string('coating');
            $table->string('category');
            $table->softDeletes();
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
        Schema::dropIfExists('airport_ways');
    }
}
