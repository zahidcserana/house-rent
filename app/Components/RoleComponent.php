<?php

namespace App\Components;

use App\Models\Role;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Http\Requests\Role\DestroyRequest;

class RoleComponent extends BaseComponent
{
    public function store(StoreRequest $request)
    {
        $input = $request->validated();

        $role = Role::create($input);

        return $role;
    }

    public function update(UpdateRequest $request, Role $role)
    {
        $input = $request->validated();

        $role->update($input);

        return $role;
    }

    public function destroy(DestroyRequest $request, Role $role)
    {
        $role->delete();

        $response = ['id' => $role->id, 'name' => $role->name];

        return $response;
    }
}
