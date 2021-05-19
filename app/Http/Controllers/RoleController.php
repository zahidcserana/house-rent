<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Role;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Http\Requests\Role\DestroyRequest;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
    public function index()
    {
        $param = RoleResource::collection(Role::all());

        return Inertia::render('settings/role/index', ['param' => $param]);
    }

    public function create()
    {
        return Inertia::render('settings/role/create');
    }

    public function store(StoreRequest $request)
    {
        app()->role->store($request);

        return Redirect::route('role.index')->with('message', 'Role Created Successfully.');
    }

    public function edit(Role $role)
    {
        $param['data'] =  $role;

        return Inertia::render('settings/role/edit', ['param' => $param]);
    }

    public function update(UpdateRequest $request, Role $role)
    {
        app()->role->update($request, $role);

        return redirect()->back()->with('message',  __('Data successfully updated.'));
    }

    public function destroy(DestroyRequest $request, Role $role)
    {
        app()->role->destroy($request, $role);

        return redirect()->back()->with('message',  __('Data successfully deleted.'));
    }
}
