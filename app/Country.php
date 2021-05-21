<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Country extends Model
{
	use SoftDeletes;
    protected $fillable = ['name', 'alfa2','alfa3','code'];
}
