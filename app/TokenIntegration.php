<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TokenIntegration extends Model
{
    protected $fillable = ['expired_time','type','token'];
}
