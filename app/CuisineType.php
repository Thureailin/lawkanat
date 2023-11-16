<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuisineType extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'name',  
        'created_by',
        'meal_id',
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];

    public function meal() {
        return $this->belongsTo(Meal::class);
    }

    public function items() {

        return $this->hasMany(MenuItem::class);
    }
}
