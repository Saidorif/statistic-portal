<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Region;
use App\Expectation;
use Illuminate\Database\Eloquent\SoftDeletes;
class RegionPlanModel extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','region_id','number','date'];

    public function region(){
    	return $this->belongsTo(Region::class,'region_id');
    }

    public function exception(){
    	return $this->hasMany(Expectation::class,'plan_id')->with(['busexpect']);
    }

    public function exceptionFakt(){
    	return $this->hasMany(Expectation::class,'plan_id')->withCount(['acceptedFakt','rejected_fakt','waiting_fakt']);
    }

}
