<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public $timestamps = true;
	public $guarded = ['id'];

	protected $fillable = ['user_id', 'method', 'path', 'data', 'ip_address'];

	public function user() 
	{
		return $this->belongsTo(User::class);
	}
}
