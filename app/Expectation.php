<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expectation extends Model
{
    protected $fillable = ['company_name','bus_qty','bus_id','date','region_id'];
}
