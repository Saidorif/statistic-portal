<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TokenIntegration extends Model
{
	use SoftDeletes;
    protected $fillable = ['expired_time','type','token'];
}
