<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TableType extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

     protected $fillable = [ 
       'name','prefix','created_by'
    ];
}
