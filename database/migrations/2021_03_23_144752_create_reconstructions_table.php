<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReconstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reconstructions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('offerbuilding_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('asos');
            $table->text('recon_hakim')->nullable();
            $table->string('summa')->nullable();
            $table->string('status');
            $table->text('comment')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // $table->foreign('offerbuilding_id')
            //     ->references('id')
            //     ->on('offerbuildings')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reconstructions');
    }
}
