<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AirportInfo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AirportName extends Model
{
    use SoftDeletes;
    protected $fillable = ["name"];

    public function airportinfo(){
    	return $this->hasMany(AirportInfo::class,"airport_id");
    }
}
