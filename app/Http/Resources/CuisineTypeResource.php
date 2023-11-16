<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CuisineTypeResource extends JsonResource
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

        $meal = $this->meal;

        return [
            'cuisine_type_id' => $this->id,
            'cuisine_type_name' => $this->name,
            'meal' => $meal->name,
        ];
    }
}
