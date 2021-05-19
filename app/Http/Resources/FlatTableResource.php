<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlatTableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        unset($resource);

        $resource['id'] = $this->id;
        $resource['name'] = $this->name;
        $resource['slug'] = $this->slug;
        $resource['rent'] = $this->rent;
        $resource['status'] = $this->status;
        $resource['created_at'] = $this->created_at;
        $resource['customer'] = ['url' => route('customer.edit', ['customer' => $this->customer]), 'name' => $this->customer->name];
        $resource['house'] = ['url' => route('house.edit', ['house' => $this->house]), 'name' => $this->house->name];
        $resource['link_edit'] = route('flat.edit', ['flat' => $this]);
        $resource['link_delete'] = ['token' => csrf_token(), 'url' => route('flat.destroy', ['id' => $this->id, 'flat' => $this])];

        return $resource;
    }
}
