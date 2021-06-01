<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirwaysCompanyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airways_company_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('airways_company_id');
            $table->text('address');
            $table->string('year');
            $table->integer('fleet_size');
            $table->string('call_name');
            $table->integer('destination_qty');
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
        Schema::dropIfExists('airways_company_infos');
    }
}
