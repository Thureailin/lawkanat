<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['title','reward','amount','percent','foc_items','type','voucher_amount','purchase_item','purchase_time','start_date','end_date','customer_console'];
}
