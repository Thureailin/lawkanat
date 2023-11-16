<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

     protected $fillable = [ 
       'town_name','delivery_charges'
    ];

    public function table_type() {
		return $this->belongsTo(TableType::class);
	}
}