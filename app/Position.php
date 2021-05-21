<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Position extends Model
{
	use SoftDeletes;
    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class,'position_id');
    }
}
