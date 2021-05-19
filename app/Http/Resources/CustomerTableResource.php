<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerTableResource extends JsonResource
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
        $resource['account_balance'] = $this->account_balance;
        $resource['status'] = $this->status;
        $resource['flats'] = new FlatCollection($this->flats);
        $resource['created_at'] = $this->created_at;
        $resource['user'] = ['url' => route('user.edit', ['user' => $this->user]), 'name' => $this->user->name];
        $resource['link_edit'] = route('customer.edit', ['customer' => $this]);
        $resource['link_delete'] = ['token' => csrf_token(), 'url' => route('customer.destroy', ['id' => $this->id, 'customer' => $this])];

        return $resource;
    }
}
