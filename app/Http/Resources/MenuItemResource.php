<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
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

        $url = url("/") . '/photo/Item/' ;

        $cuisine_type = $this->cuisine_type;

        $option_lists = $this->option()->whereNull('deleted_at')->get(array('id','name','sale_price','size'));

        foreach ($option_lists as $option) {
            
            if ($option->size == 1) {
                
                $option->size = "Small";

            } elseif ($option->size == 2) {

                $option->size = "Normal";

            }else {
                $option->size = "Large";
            }
        }

        return [
            'menu_item_id' => $this->id,
            'menu_item_code' => $this->item_code,
            'menu_item_name' => $this->item_name,
            'cuisine_type' => $cuisine_type->name,
            'photo_path' => $url . $this->photo_path,
            'option' => $option_lists,
        ];
    }
}
