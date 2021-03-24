<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Offerbuilding;

class Reconstruction extends Model
{
	protected $fillable = ['offerbuilding_id','start_date','end_date','asos','recon_hakim','summa','comment','status'];

	public function offerbuilding(){
		return $this->belongsTo(Offerbuilding::class,'offerbuilding_id')->with(['region','area','station']);
	}
	
}
