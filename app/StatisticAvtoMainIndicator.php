<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Region;
use Illuminate\Database\Eloquent\SoftDeletes;
class StatisticAvtoMainIndicator extends Model
{
	use SoftDeletes;
    protected $fillable = ['region_id','type','year','quarter_one','quarter_two','quarter_three','quarter_four'];
    	
    public function region(){
    	return $this->belongsTo(Region::class,'region_id');
    }

    public function scopeType($query,$year){
    	return $query->where(['year'=>$year])->get();
    }
}
