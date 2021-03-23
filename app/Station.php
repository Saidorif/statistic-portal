<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Region;
use App\Area;

class Station extends Model
{
    protected $fillable = ['name','region_id','area_id','station_type','class'];

    public function region()
    {
        return $this->belongsTo(Region::class,'region_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class,'area_id');
    }
}
