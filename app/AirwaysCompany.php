<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use App\AirportInfo;

class AirwaysCompany extends Model
{
    use SoftDeletes;
    protected $fillable = ["name"];

    // public function airportinfo(){
    //     return $this->belongsTo(AirportInfo::class,"airport_id");
    // }
}