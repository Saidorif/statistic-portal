<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Region;
use Illuminate\Database\Eloquent\SoftDeletes;
class Area extends Model
{
	use SoftDeletes;
    protected $fillable = ['name','region_id'];

    public function region()
    {
        return $this->belongsTo(Region::class,'region_id');
    }
}
