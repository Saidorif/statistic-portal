<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusExpectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_expects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('expect_id');
            $table->integer('bus_id');
            $table->string('bus_qty');
            $table->timestamps();

            $table->foreign('expect_id')
                ->references('id')
                ->on('expectations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bus_expects');
    }
}
