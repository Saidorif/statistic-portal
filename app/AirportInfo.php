<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PlaneType;
use App\AviaCity;
use App\AirportCode;
use App\AirportWay;
use App\AirportRecon;
use App\AirportName;

use Illuminate\Database\Eloquent\SoftDeletes;
class AirportInfo extends Model
{
	use SoftDeletes;
    protected $fillable = ['airport_name_id','year','address','flight_mode','freedom_air'];

    public function plane_type(){
    	return $this->hasMany(PlaneType::class,'airport_id');
    }

    public function avia_city(){
    	return $this->hasMany(AviaCity::class,'airport_id');
    }

    public function airport_code(){
    	return $this->hasMany(AirportCode::class,'airport_id');
    }

    public function airport_way(){
        return $this->hasMany(AirportWay::class,'airport_id');
    }

    public function airport_recon(){
        return $this->hasMany(AirportRecon::class,'airport_id');
    }

    public function airport_name(){
        return $this->belongsTo(AirportName::class,'airport_name_id');
    }
}
