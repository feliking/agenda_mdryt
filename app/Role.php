<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    use SoftDeletes;
    protected $fillable = ['name', 'display_name', 'description'];
    protected $guard = ['id'];
    public $timestamps = true;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
