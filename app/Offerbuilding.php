<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Area;
use App\Region;
use App\Station;

class Offerbuilding extends Model
{
    protected $fillable = [
    	'type_of_construction',
    	'longitude', //longitude
        'latitude', //latitude
        'name', //Юридик шахс номи
    	'company_name', //Корхона номи
    	'station_id', //Автовокзал (автостанция) номи
    	'inn', //ИНН
    	'address', //жойлашган жойи
    	'region_id',
    	'area_id',
    	'asos', //асос
    	'offer_hakim', //ер ажратиш ва қурилиш учун ҳокимнинг қарори
    	'price', //лойиҳа ва унинг қиймати
    	'bank_credit', // молиялаштириш манбаи (маҳаллий бюджет, тадбиркор маблағи, банк кредити)
    	'land_area', // ер майдони кв.м
    	'time_of_construction_start', // қурилиш ишлари бошланган вақти
    	'time_of_construction_end', //топшириш муддати
    	'telephon', //телефон рақами
    	'capacity_passenger', // бир вақтдаги йўловчи сиғими
    	'work_schedule', // иш тартиби
    	'ustav_fond', // устав фонди (давлат улуши ва таъсисчилар улуши)
    	'project_photo', // проект расми
    	'status',
    	'created_by',
    	'updated_by',
    ];

    public function region(){
        return $this->belongsTo(Region::class,'region_id');
    }
    public function area(){
        return $this->belongsTo(Area::class,'area_id');
    }
    public function station(){
        return $this->belongsTo(Station::class,'station_id');
    }
}
