<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReconstructionGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reconstruction_galleries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('reconstruction_id');
            $table->text('name');
            $table->timestamps();

            $table->foreign('reconstruction_id')
                ->references('id')
                ->on('reconstructions')
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
        Schema::dropIfExists('reconstruction_galleries');
    }
}
