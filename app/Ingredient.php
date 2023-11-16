<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'name', 
        'purchase_price', 
        'unit',
        'reorder_quantity',
        'instock_quantity',
        'brand_name',
        'supplier_name',
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

    public function option() {
		return $this->belongsToMany('App\Option')->withPivot('id','amount');
	}
}
