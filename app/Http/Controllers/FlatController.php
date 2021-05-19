<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\User;
use Inertia\Inertia;
use App\Models\House;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Resources\FlatResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Flat\StoreRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Flat\UpdateRequest;
use App\Http\Resources\FlatTableResource;
use App\Http\Requests\Flat\DestroyRequest;

class FlatController extends Controller
{
    public function index(Request $request)
    {
        $flatCollection = Flat::query();

        if (!$this->adminUser()) {
            $flatCollection = $flatCollection->whereHas('house', function ($query) {
                $query->where('user_id', Auth::user()->id);
            });
        }

        $flatCollection->when($request['house_id'], function ($q) use ($request) {
            return $q->where('house_id', $request['house_id']);
        });

        $data = $flatCollection->get();

        $param['data'] = FlatTableResource::collection($data);
        $param['status'] = \config('settings.flat_status');

        return Inertia::render('settings/flat/index', ['param' => $param]);
    }

    public function create()
    {
        $param['houses'] = $this->houseList();
        $param['customers'] = $this->customerList();
        $param['status'] = \config('settings.flat_status');

        return Inertia::render('settings/flat/create', ['param' => $param]);
    }

    public function store(StoreRequest $request)
    {
        app()->flat->store($request);

        return Redirect::route('flat.index')->with('message', 'Flat Created Successfully.');
    }

    public function edit(Flat $flat)
    {
        $param['data'] =  $flat;
        $param['houses'] = $this->houseList();
        $param['customers'] = $this->customerList();
        $param['status'] = \config('settings.flat_status');

        return Inertia::render('settings/flat/edit', ['param' => $param]);
    }

    public function update(UpdateRequest $request, Flat $flat)
    {
        app()->flat->update($request, $flat);

        return redirect()->back()->with('message',  __('Data successfully updated.'));
    }

    public function destroy(DestroyRequest $request, Flat $flat)
    {
        app()->flat->destroy($request, $flat);

        return redirect()->back()->with('message',  __('Data successfully deleted.'));
    }
}
