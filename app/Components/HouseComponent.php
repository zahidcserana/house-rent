<?php

namespace App\Components;

use App\Models\House;
use App\Http\Requests\House\StoreRequest;
use App\Http\Requests\House\UpdateRequest;
use App\Http\Requests\House\DestroyRequest;

class HouseComponent extends BaseComponent
{
    public function store(StoreRequest $request)
    {
        $input = $request->validated();

        $house = House::create($input);

        return $house;
    }

    public function update(UpdateRequest $request, House $house)
    {
        $input = $request->validated();

        $house->update($input);

        $house->refresh();

        return $house;
    }

    public function destroy(DestroyRequest $request, House $house)
    {
        $house->flats()->delete();

        $house->delete();

        $response = ['id' => $house->id, 'name' => $house->name, 'user_id' => $house->user_id];

        return $response;
    }
}
