<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AirportInfo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AirportWay extends Model
{
    use SoftDeletes;
    protected $fillable = ["airport_id","number","width",'height','coating','category'];

    public function airportinfo(){
    	return $this->belongsTo(AirportInfo::class,"airport_id");
    }
}
