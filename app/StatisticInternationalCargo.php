<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Region;

class StatisticInternationalCargo extends Model
{
    protected $fillable = [
    	'region_id',
    	'type',
    	'year',
    	'yanvar',
    	'fevral',
    	'mart',
    	'aprel',
    	'may',
    	'iyun',
    	'iyul',
    	'avgust',
    	'sentabr',
    	'oktabr',
    	'noyabr',
    	'dekabr',
	];
    	
    public function region(){
    	return $this->belongsTo(Region::class,'region_id');
    }
}
