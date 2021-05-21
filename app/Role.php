<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Role extends Model
{
	use SoftDeletes;
    protected $fillable = ['name','label'];
    
    public function permissions()
    {
        return $this->hasMany(\App\Permission::class, 'role_id');
    }
    
    public function permissionsWith()
    {
        return $this->hasMany(\App\Permission::class, 'role_id')->with(['controller','action']);
    }
}
