<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    use SoftDeletes;
    protected $fillable = ['name', 'display_name', 'description'];
    protected $guard = ['id'];
    public $timestamps = true;

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
