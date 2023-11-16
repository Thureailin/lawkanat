<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

     protected $fillable = [ 
       'table_number','floor','status','table_type_id'
    ];

    public function table_type() {
		return $this->belongsTo(TableType::class);
	}
}
