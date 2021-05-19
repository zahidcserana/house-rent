<?php

namespace App\Components;

use App\Models\Flat;
use App\Http\Requests\Flat\StoreRequest;
use App\Http\Requests\Flat\UpdateRequest;
use App\Http\Requests\Flat\DestroyRequest;

class FlatComponent extends BaseComponent
{
    public function store(StoreRequest $request)
    {
        $input = $request->validated();

        $flat = Flat::create($input);

        return $flat;
    }

    public function update(UpdateRequest $request, Flat $flat)
    {
        $input = $request->validated();

        $flat->update($input);

        $flat->refresh();

        return $flat;
    }

    public function destroy(DestroyRequest $request, Flat $flat)
    {
        $flat->delete();

        $response = ['id' => $flat->id, 'name' => $flat->name, 'house_id' => $flat->house_id];

        return $response;
    }
}
