<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AirportInfo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AirportRecon extends Model
{
    use SoftDeletes;
    protected $fillable = ["airport_id","job_type","year",'description'];

    public function airportinfo(){
    	return $this->belongsTo(AirportInfo::class,"airport_id");
    }
}
