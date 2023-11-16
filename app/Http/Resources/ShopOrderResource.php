<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        $table = $this->table;

        if ($this->status == 1) {
            
            $status = "Pending";

        } else {

            $status = "Finished";
        }

         if ($this->table_id == 0) {
            
            $table_number = "Take Away";

        } else {

            $table_number = $table->table_number;
        }

        $option_lits = array();

        foreach($this->option as $opt){

            if ($opt->pivot->status == 0) {
                
                $opt_status = "Ordered" ;

            } elseif ($opt->pivot->status == 1) {
                
                $opt_status = "Cooking" ;

            } else{

                $opt_status = "Finished" ;

            }   

            $collection = collect(['option_id','name', 'menu_item_name','price','note','quantity','status']);

            $combined = $collection->combine([$opt->id,$opt->name,$opt->menu_item->item_name,$opt->sale_price,$opt->pivot->note,$opt->pivot->quantity,$opt_status]);

            array_push($option_lits, $combined);

        }

        return [
            'order_id' => $this->id,
            'order_number' => $this->order_number,
            'status' => $status,
            'table' => $table_number,
            'option_lists' => $option_lits,
        ];
    }
}
