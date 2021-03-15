<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BusModel;
use App\Expectation;
class Fakt extends Model
{
	/**
		Expectation=>expect_id
		Bus=>bus_id
		Автобус сиғими=>capacity
		Молиялаштириш манбаи=>bank_credit
		Автобус нарҳи=>auto_price
		Ҳарид қилинган сана=>purchase_date
		Давлат рўйҳатидан ўтганлик ҳақида гувохнома рақами=>registr_cerf
		status=>status
		comment=>comment
	**/
    protected $fillable = [
    	'expect_id',
    	'bus_id',
    	'capacity',
    	'bank_credit',
    	'auto_price',
    	'purchase_date',
    	'registr_cerf',
    	'status',
    	'comment'
    ];

    public function bus(){
    	return $this->belongsTo(BusModel::class,'bus_id');
    }

    public function expectation(){
    	return $this->belongsTo(Expectation::class,'expect_id');
    }
}
