<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $with = ['menu_item'];

    protected $fillable = [
		'name',
		'sale_price',
		'est_cost_price',
		'size',
		'created_by',
        'menu_item_id',
        'deleted_at',
        'brake_flag',
	];

	protected $hidden = [
        'created_at','updated_at'
    ];

	public function menu_item() {
		return $this->belongsTo(MenuItem::class);
	}

	public function ingredient() {
		return $this->belongsToMany('App\Ingredient')->withPivot('id','amount');
	}
}
