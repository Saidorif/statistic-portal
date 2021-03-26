<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferbuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offerbuildings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_of_construction')->nullable();
            $table->string('name');
            $table->string('company_name');
            $table->integer('station_id');
            $table->string('inn')->unique();
            $table->text('address');
            $table->bigInteger('region_id')->nullable();
            $table->bigInteger('area_id')->nullable();
            $table->text('asos');
            $table->text('offer_hakim');
            $table->string('price');
            $table->string('longitude'); 
            $table->string('latitude');
            $table->string('bank_credit');
            $table->string('land_area');
            $table->date('time_of_construction_start')->nullable();
            $table->date('time_of_construction_end')->nullable();
            $table->string('telephon');
            $table->string('capacity_passenger');
            $table->string('work_schedule');
            $table->string('ustav_fond');
            $table->text('project_photo')->nullable();
            $table->text('comment')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('offerbuildings');
    }
}
