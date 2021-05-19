<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = parent::toArray($request);

        $resource['house'] = new HouseResource($this->house);
        unset($resource['house_id']);

        $resource['customer'] = new CustomerResource($this->customer);
        unset($resource['customer_id']);

        return $resource;
    }
}
