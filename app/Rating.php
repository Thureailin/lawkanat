<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [ 
        'customer_id','table_id','voucher_id','employee_id','star','feedback','type'
     ];
}
