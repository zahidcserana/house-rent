<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\StoreRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserTableResource;
use App\Http\Requests\User\DestroyRequest;

class UserController extends Controller
{
    public function index()
    {
        $param['data'] = UserTableResource::collection(User::get());
        $param['status'] = \config('settings.common_status');

        return Inertia::render('user/index', ['param' => $param]);
    }

    public function userList()
    {
        $data = app()->user->userList();

        return response()->json($data);
    }

    public function create()
    {
        $param['roles'] = Role::select('id', 'name', 'description')->get();

        return Inertia::render('user/create', ['param' => $param]);
    }

    public function store(StoreRequest $request)
    {
        app()->user->store($request);

        return Redirect::route('user.index')->with('message', 'User Created Successfully.');
    }

    public function edit(User $user)
    {
        $param['data'] =  $user;
        $param['roles'] = Role::select('id', 'name', 'description')->get();

        return Inertia::render('user/edit', ['param' => $param]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        app()->user->update($request, $user);

        return redirect()->back()->with('message',  __('Data successfully updated.'));
    }

    public function destroy(DestroyRequest $request, User $user)
    {
        app()->user->destroy($request, $user);

        return redirect()->back()->with('message',  __('Data successfully deleted.'));
    }

    public function changePassword()
    {
        return Inertia::render('user/changePassword');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_password' => ['same:new_password'],
        ]);

        $userId = auth()->user()->id;

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        Auth::loginUsingId($userId, TRUE);

        return Redirect::route('changePassword')->with('message', 'Password Updated Successfully.');
    }
}
