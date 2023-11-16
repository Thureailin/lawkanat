<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopOrder extends Model
{
    protected $guarded = [];
    protected $with = ['table'];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    protected $fillable = [
       'order_number','status','table_id','voucher_id','type'
    ];

    public function option() {
		return $this->belongsToMany('App\Option')->withPivot('id','quantity','note','status','tocook','add_same_item_status','new_status','old_quantity','new_quantity');
	}

	public function table() {

		return $this->belongsTo(Table::class);
	}

    public function voucher() {

        return $this->belongsTo(Voucher::class);
    }
}
