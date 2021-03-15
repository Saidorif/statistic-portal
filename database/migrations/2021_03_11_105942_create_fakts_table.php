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
            $table->string('auto_price')->nullable();
            $table->string('purchase_date')->nullable();
            $table->string('registr_cerf')->nullable();
            $table->string('status')->nullable();
            $table->text('comment')->nullable();
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
