<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
        $resource['description'] = $this->description;
        $resource['slug'] = $this->slug;
        $resource['status'] = $this->status;
        $resource['created_at'] = $this->created_at;
        $resource['link_edit'] = route('role.edit', ['role' => $this]);
        $resource['link_delete'] = ['token' => csrf_token(), 'url' => route('role.destroy', ['id' => $this->id, 'role' => $this])];

        return $resource;
    }
}
