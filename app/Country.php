<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name', 'alfa2','alfa3','code'];
}
