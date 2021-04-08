<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticInternationalMoneyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistic_international_money', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('year');
            $table->double('yanvar',15,2)->nullable();
            $table->double('fevral',15,2)->nullable();
            $table->double('mart',15,2)->nullable();
            $table->double('aprel',15,2)->nullable();
            $table->double('may',15,2)->nullable();
            $table->double('iyun',15,2)->nullable();
            $table->double('iyul',15,2)->nullable();
            $table->double('avgust',15,2)->nullable();
            $table->double('sentabr',15,2)->nullable();
            $table->double('oktabr',15,2)->nullable();
            $table->double('noyabr',15,2)->nullable();
            $table->double('dekabr',15,2)->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('statistic_international_money');
    }
}
