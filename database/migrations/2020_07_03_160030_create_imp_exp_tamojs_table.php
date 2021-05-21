<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpExpTamojsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imp_exp_tamojs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mode');//Режим имрорт или экспорт
            $table->date('date');//Дата
            $table->string('vedcode');//Код ТН ВЭД
            $table->string('product');//Товар
            $table->bigInteger('country_code');//Код страна
            $table->bigInteger('code_group_id');//Группа Код ТН ВЭД
            $table->bigInteger('country_id');
            $table->string('country_name');//Страна грузотпровитель / грузополучателя
            $table->bigInteger('transport_type');//Вид транспорта
            $table->bigInteger('transport_country_code');//Страна регстрация транспорта
            $table->double('weight',15,2);
            $table->double('cost',15,2);
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
        Schema::dropIfExists('imp_exp_tamojs');
    }
}
