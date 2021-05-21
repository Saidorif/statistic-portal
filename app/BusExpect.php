<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Expectation;
use App\BusModel;
use Illuminate\Database\Eloquent\SoftDeletes;
class BusExpect extends Model
{
	use SoftDeletes;
    protected $fillable = ['expect_id','bus_id','bus_qty'];


    public function expectation(){
    	return $this->belongsTo(Expectation::class,'expect_id');
    }

    public function bus(){
    	return $this->belongsTo(BusModel::class,'bus_id');
    }
}
