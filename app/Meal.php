<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
	protected $guarded = [];

    protected $fillable = [
        'name',  
        'created_by',
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

     public function cuisine_type() {

        return $this->hasMany(CuisineType::class);
    }
}
