<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AirportInfo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AirportExpect extends Model
{
    use SoftDeletes;
    protected $fillable = ["airport_id","expect_date","type","reys_qty","seats_qty","passengers_qty","load_capacity","reys_qty_fakt","seats_qty_fakt","passengers_qty_fakt","load_capacity_fakt"];

    public function airportinfo(){
    	return $this->belongsTo(AirportInfo::class,"airport_id")->with(['airport_name']);
    }

}
