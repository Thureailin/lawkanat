<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $fillable = [
		 'town_code','town_name','state_id','status','delivery_charges'
	];

	public function town(){
		return $this->belongsTo('App\State');
	}
}
