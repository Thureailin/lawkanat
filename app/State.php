<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
		 'state_code','state_name'
	];

	public function town(){
		return $this->hasMany('App\Town');
	}
}
