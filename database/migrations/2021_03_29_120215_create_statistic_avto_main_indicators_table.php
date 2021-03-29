<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticAvtoMainIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_avto_main_indicators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('region_id');
            $table->string('type');
            $table->date('year');
            $table->string('quarter');
            $table->string('number');
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
        Schema::dropIfExists('statistic_avto_main_indicators');
    }
}
