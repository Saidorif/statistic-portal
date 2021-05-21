<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Conts extends Model
{
	use SoftDeletes;
    protected $fillable = ['name', 'label'];

    public function actions()
    {
        return $this->hasMany(\App\Action::class, 'conts_id');
    }
}
