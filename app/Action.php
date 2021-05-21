<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Action extends Model
{
	use SoftDeletes;
    protected $fillable = ['name', 'conts_id', 'code'];

    public function controller()
    {
        return $this->belongsTo(\App\Conts::class, 'conts_id');
    }
}
