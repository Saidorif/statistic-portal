<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Expectation;
use App\Area;
use App\TarifCity;
class Region extends Model
{
    protected $fillable = ['name'];

    public function area()
    {
        return $this->hasMany(Area::class,'region_id');
    }
    
    public function tarifcity()
    {
        return $this->hasMany(TarifCity::class,'region_id');
    }

    public function expectation(){
    	return $this->hasMany(Expectation::class,'region_id');
    }
}
