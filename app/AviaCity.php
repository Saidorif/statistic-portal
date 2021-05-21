<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AirportInfo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AviaCity extends Model
{
    use SoftDeletes;
    protected $fillable = ["airport_id","name"];

    public function airport(){
    	return $this->belongsTo(AirportInfo::class,"airport_id");
    }
}
