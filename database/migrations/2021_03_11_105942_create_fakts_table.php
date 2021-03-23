<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaktsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fakts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('expect_id');
            $table->integer('bus_id');
            $table->string('capacity')->nullable();
            $table->string('bank_credit')->nullable();
            $table->string('auto_price_sum')->nullable();
            $table->string('auto_price_dollar')->nullable();
            $table->string('auto_price_euro')->nullable();
            $table->string('bank_contract')->nullable();
            $table->string('zavod_contract')->nullable();
            $table->string('purchase_date')->nullable();
            $table->string('registr_cerf')->nullable();
            $table->string('status')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('fakts');
    }
}
