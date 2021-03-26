<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reconstruction;

class ReconstructionGallery extends Model
{
    protected $fillable = ['reconstruction_id','name'];

    public function reconstruction(){
    	return $this->belongsTo(Reconstruction::class,'reconstruction_id');
    }
}
