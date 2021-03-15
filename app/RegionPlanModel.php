<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Region;
class RegionPlanModel extends Model
{
    protected $fillable = ['name','region_id','number','date'];

    public function region(){
    	return $this->belongsTo(Region::class,'region_id');
    }
}
