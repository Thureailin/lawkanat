<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
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

        $menu_item = $this->menu_item;

        if ($this->size == 1) {
                
            $size = "Small";

        } elseif ($this->size == 2) {

            $size = "Normal";

        }else {
            $size = "Large";
        }

        return [
            'option_id' => $this->id,
            'name' => $this->name,
            'sale_price' => $this->sale_price,
            'size' => $size,
            'meni_item' => $menu_item->item_name,
        ];
    }
}
