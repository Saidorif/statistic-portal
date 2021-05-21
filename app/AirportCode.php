<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AirportInfo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AirportCode extends Model
{
    use SoftDeletes;
    protected $fillable = ["airport_id","tas_id","code"];

    public function airportinfo(){
    	return $this->belongsTo(AirportInfo::class,"airport_id");
    }
}
