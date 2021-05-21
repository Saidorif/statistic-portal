<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Region;
use Illuminate\Database\Eloquent\SoftDeletes;
class StatisticInternationalCargo extends Model
{
    use SoftDeletes;
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
