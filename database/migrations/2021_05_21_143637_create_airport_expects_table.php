<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirportExpectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airport_expects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('airport_id');
            $table->date('expect_date'); 
            $table->string('type');
            $table->string('reys_qty');
            $table->string('seats_qty');
            $table->string('passengers_qty');
            $table->string('load_capacity');
            $table->string('reys_qty_fakt')->nullable();
            $table->string('seats_qty_fakt')->nullable();
            $table->string('passengers_qty_fakt')->nullable();
            $table->string('load_capacity_fakt')->nullable();
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
        Schema::dropIfExists('airport_expects');
    }
}
