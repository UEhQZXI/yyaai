<?php

namespace App\Http\Controllers\Api\V1\Store;

use App\Http\Requests\Api\V1\Store\AddressRequest;
use App\Models\Store\Address;
use App\Http\Controllers\Api\V1\Controller;

class AddressController extends Controller
{

    public function store(AddressRequest $request, Address $address)
    {
        if ($request->has('is_default') && $request->is_default == 1) {
            Address::where('user_id', $this->user()->id)->update(['is_default' => 0]);
        }

        $address->fill($request->all());
        $address->user_id = $this->user()->id;
        $address->save();

        return $this->response->array(['message' => 'success', 'data' => []]);
    }


    public function destroy(Address $address)
    {
        $this->authorize('destroy', $address);

        Address::where('id', $address->id)->update(['status' => 0]);

        return $this->response->array(['message' => 'success', 'data' => []]);
    }


    public function update(AddressRequest $request, Address $address)
    {
        $this->authorize('update', $address);

        if ($request->is_default) {
            Address::where('user_id', $this->user()->id)->update(['is_default' => 0]);
        }

        Address::where('id', $address->id)->update($request->all());

        return $this->response->array(['message' => 'success', 'data' => []]);
    }


    public function userIndex()
    {
        $address = Address::select(['id', 'user_name', 'user_phone', 'user_tel', 'area1', 'area2', 'area3', 'address', 'is_default', 'created_at'])
            ->where(['user_id' => $this->user()->id, 'status' => 1])
            ->get();

        return $this->response->array(['message' => 'success', 'data' => $address]);
    }
}