<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = [];

    protected $fillable = [
    	'supplier_name',
		'total_quantity',
		'total_price',
		'purchase_date',
		'purchase_by',
	];

	public function ingredient() {

		return $this->belongsToMany('App\Ingredient')->withPivot('id','quantity','price');
	}

	public function user(){

        return $this->belongsTo('App\User','purchase_by');
    }
}
