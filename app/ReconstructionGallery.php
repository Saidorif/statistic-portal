<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reconstruction;
use Illuminate\Database\Eloquent\SoftDeletes;
class ReconstructionGallery extends Model
{
	use SoftDeletes;
    protected $fillable = ['reconstruction_id','name'];

    public function reconstruction(){
    	return $this->belongsTo(Reconstruction::class,'reconstruction_id');
    }
}
