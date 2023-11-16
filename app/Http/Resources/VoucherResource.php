<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoucherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        if ($this->status == 1) {
            
            $status = "Pending";

        } else {

            $status = "Finished";
        }

        $user = $this->user;

        $option_lits = array();

        foreach($this->option as $opt){

            $collection = collect(['option_id','name', 'menu_item_name','price','quantity']);

            $combined = $collection->combine([$opt->id,$opt->name,$opt->menu_item->item_name,$opt->sale_price,$opt->pivot->quantity]);

            array_push($option_lits, $combined);

        }

        return [
            'voucher_id' => $this->id,
            'voucher_number' => $this->voucher_code,
            'total_price' => $this->total_price,
            'total_quantity' => $this->total_quantity,
            'sale_by' => $user->name,
            'date' => $this->voucher_date,
            'option_lists' => $option_lits,
        ];


        //return parent::toArray($request);
    }
}
