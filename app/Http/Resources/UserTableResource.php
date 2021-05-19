<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTableResource extends JsonResource
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
        $resource['email'] = $this->email;
        $resource['mobile'] = $this->mobile;
        $resource['status'] = $this->status;
        $resource['created_at'] = $this->created_at;
        $resource['role'] = ['url' => route('role.edit', ['role' => $this->role]), 'name' => $this->role->name];
        $resource['link_edit'] = route('user.edit', ['user' => $this]);
        $resource['link_delete'] = ['token' => csrf_token(), 'url' => route('user.destroy', ['id' => $this->id, 'user' => $this])];

        return $resource;
    }
}
