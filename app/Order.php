<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'created_at', 'updated_at','deleted_at'
    ];

    protected $fillable = [
       'order_number','address','name','phone','note','order_date','delivered_date','accepted_date','total_quantity','price','delivery_charges','status','remark','customer_id','employee_id','voucher_id','deleted_at','is_mobile'
    ];

    public function option() {
		return $this->belongsToMany('App\Option')->withPivot('id','quantity');
	}

	public function customer() {

		return $this->belongsTo('App\User','customer_id');
	}

	public function employee() {

		return $this->belongsTo('App\User','employee_id');
	}

	public function voucher() {

        return $this->belongsTo(Voucher::class);
    }
}
