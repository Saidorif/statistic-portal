<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\AirportInfo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AviaDirection extends Model
{
    use SoftDeletes;
    protected $fillable = ["name","direction_type","avia_type","flight_qty"];

    // public function airport(){
    //     return $this->belongsTo(AirportInfo::class,"airport_id");
    // }
}
