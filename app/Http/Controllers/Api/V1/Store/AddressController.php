<?php

namespace App\Http\Controllers\Api\V1\Store;

use App\Http\Requests\Api\V1\Store\AddressRequest;
use App\Models\Store\Address;
use Illuminate\Http\Request;
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

    public function update()
    {

    }
}
