<?php

namespace App\Components;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserTableResource;
use App\Http\Requests\User\DestroyRequest;

class UserComponent extends BaseComponent
{
    public function store(StoreRequest $request)
    {
        $input = $request->validated();
        $input['password'] = Hash::make($request->password);

        $user = User::create($input);

        return $user;
    }

    public function userList()
    {
        $where = [];

        if (!$this->adminUser()) {
            $where = array_merge(array(['id', Auth::user()->id]), $where);
        } else {
            $where = array_merge(array(['role_id', '<>', 1]), $where);
        }

        $users = User::where($where)->get();
        $data = UserTableResource::collection($users);

        return $data;
    }

    public function update(UpdateRequest $request, User $user)
    {
        $input = $request->validated();

        $user->update($input);

        return $user;
    }

    public function destroy(DestroyRequest $request, User $user)
    {
        $user->delete();

        $response = ['id' => $user->id, 'name' => $user->name];

        return $response;
    }
}
