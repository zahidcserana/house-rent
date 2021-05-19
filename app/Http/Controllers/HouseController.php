<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\HouseResource;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\House\StoreRequest;
use App\Http\Requests\House\UpdateRequest;
use App\Http\Resources\HouseTableResource;
use App\Http\Requests\House\DestroyRequest;

class HouseController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query();
        $where = array();

        if (!$this->adminUser()) {
            $where = array_merge(array(['houses.user_id', Auth::user()->id]), $where);
        }

        $data = House::where($where)->get();

        $param['data'] = HouseTableResource::collection($data);

        return Inertia::render('settings/house/index', ['param' => $param]);
    }

    public function create()
    {
        return Inertia::render('settings/house/create');
    }

    public function store(StoreRequest $request)
    {
        app()->house->store($request);

        return Redirect::route('house.index')->with('message', 'House Created Successfully.');
    }

    public function edit(House $house)
    {
        $param['data'] =  $house;
        $param['users'] = User::all();

        return Inertia::render('settings/house/edit', ['param' => $param]);
    }

    public function update(UpdateRequest $request, House $house)
    {
        app()->house->update($request, $house);

        return redirect()->back()->with('message',  __('Data successfully updated.'));
    }

    public function destroy(DestroyRequest $request, House $house)
    {
        app()->house->destroy($request, $house);

        return redirect()->back()->with('message',  __('Data successfully deleted.'));
    }
}
