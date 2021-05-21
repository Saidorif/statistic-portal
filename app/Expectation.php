<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Region;
use App\BusModel;
use App\RegionPlanModel;
use App\BusExpect;
use App\Fakt;
use Illuminate\Database\Eloquent\SoftDeletes;
class Expectation extends Model
{
    use SoftDeletes;
    protected $fillable = ['company_name','inn','date','plan_id','region_id'];

    public function plan(){
    	return $this->belongsTo(RegionPlanModel::class,'plan_id')->with('region');
    }

    public function busexpect(){
    	return $this->hasMany(BusExpect::class,'expect_id')->with('bus');
    }

    public function acceptedFakt(){
    	return $this->hasMany(Fakt::class,'expect_id')->where('status','accepted');
    }

    public function rejected_fakt(){
    	return $this->hasMany(Fakt::class,'expect_id')->where('status','rejected');
    }

    public function waiting_fakt(){
    	return $this->hasMany(Fakt::class,'expect_id')->where('status','waiting');
    }

    public function fakt(){
    	return $this->hasMany(Fakt::class,'expect_id');
    }
}
