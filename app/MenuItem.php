<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $fillable = [
        'item_code', 
        'item_name', 
        'photo_path',
        'customer_console',
        'created_by',
        'cuisine_type_id',
        'deleted_at'
    ];
    
    protected $hidden = [
        'created_at','updated_at'
    ];
    
	public function cuisine_type() {
        return $this->belongsTo(CuisineType::class);
    }

    public function option(){
        return $this->hasMany(Option::class);
    }
}
