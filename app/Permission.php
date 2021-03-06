<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Permission extends Model
{
    use SoftDeletes;
    protected $fillable = ['role_id', 'conts_id', 'actions', 'action_id'];

    public function role(){
        return $this->belongsTo(\App\Role::class, 'role_id');
    }

    public function controller(){
        return $this->belongsTo(\App\Conts::class, 'conts_id');
    }
    
    public function action(){
        return $this->belongsTo(\App\Action::class, 'action_id');
    }
}
