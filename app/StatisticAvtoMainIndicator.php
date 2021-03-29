<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Region;
class StatisticAvtoMainIndicator extends Model
{
    protected $fillable = ['region_id','type','year','quarter','number'];
    
    public function region(){
    	return $this->belongsTo(Region::class,'region_id');
    }
}
