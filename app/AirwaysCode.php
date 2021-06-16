<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AirwaysCompanyInfo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AirwaysCode extends Model
{
    use SoftDeletes;
    protected $fillable = ["airways_id","tas_id","code"];

    public function airwaysinfo(){
        return $this->belongsTo(AirwaysCompanyInfo::class,"airways_id");
    }
}
