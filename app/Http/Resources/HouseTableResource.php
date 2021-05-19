<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HouseTableResource extends JsonResource
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
        $resource['status'] = $this->status;
        $resource['created_at'] = $this->created_at;
        $resource['user'] = ['url' => route('user.edit', ['user' => $this->user]), 'name' => $this->user->name];
        $resource['link_edit'] = route('house.edit', ['house' => $this]);
        $resource['link_delete'] = ['token' => csrf_token(), 'url' => route('house.destroy', ['id' => $this->id, 'house' => $this])];

        return $resource;
    }
}
