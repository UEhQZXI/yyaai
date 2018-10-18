<?php

namespace App\Http\Controllers\Api\V1\Store;

use App\Http\Requests\Api\V1\Store\CartRequest;
use App\Models\Store\Cart;
use App\Models\Store\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\Controller;

class CartController extends Controller
{
    public function store(CartRequest $request, Cart $cart)
    {
        $product = Product::select(['inventory', 'current_price'])
            ->where('id', $request->product_id)
            ->first();

        if ($product->inventory < $request->product_number) {
            return $this->response->error('商品库存不足', 422);
        }

        // 总价
        $totalPrice = $request->product_number * $product->current_price;

        $cart->fill($request->all());
        $cart->user_id = $this->user()->id;
        $cart->total_price = $totalPrice;
        $cart->save();

        $cartList = Cart::where('user_id', $this->user()->id)->get();

        $cartTotalPrice = 0;

        foreach ($cartList as $value) {
            $cartTotalPrice += $value->total_price;
        }

        $collection = collect(['cart' => $cartList]);
        $collection->put('cart_total_price', sprintf('%.2f', round($cartTotalPrice, 2)));

        return $this->response->array(['message' => 'success', 'data' => $collection]);
    }

    public function destroy(Cart $cart)
    {
        $this->authorize('destroy', $cart);

        $cart->delete();

        return $this->response->array(['message' => 'success', 'data' => []]);
    }

    public function update(CartRequest $request, Cart $cart)
    {
        $this->authorize('update', $cart);

        $productNumber = $request->product_number;

        $productId = Cart::select(['product_id'])->where('id', $cart->id)->first();

        $product = Product::select(['inventory', 'current_price'])
            ->where('id', $productId->product_id)
            ->first();

        if ($product->isEmpty()) {
            return $this->response->error('商品过期不存在', 422);
        }

        if ($product->inventory < $productNumber) {
            return $this->response->error('商品库存不足', 422);
        }

        // 总价
        $totalPrice = $productNumber * $product->current_price;

        Cart::where('id', $cart->id)->update([
            'product_number' => $productNumber,
            'total_price' => $totalPrice
        ]);

        $cartList = Cart::where('user_id', $this->user()->id)->get();

        $cartTotalPrice = 0;

        foreach ($cartList as $value) {
            $cartTotalPrice += $value->total_price;
        }

        $collection = collect(['cart' => $cartList]);
        $collection->put('cart_total_price', sprintf('%.2f', round($cartTotalPrice, 2)) );

        return $this->response->array(['message' => 'success', 'data' => $collection]);
    }

    public function userIndex()
    {
        $cart = Cart::select(['id', 'product_id', 'product_number', 'total_price', 'created_at'])
            ->where('user_id', $this->user()->id)
            ->with(['product' => function ($query) {
                $query->select([
                    'id', 'category_id', 'title', 'description', 'model',
                    'original_price', 'current_price', 'inventory', 'group_number',
                    'image1', 'image2', 'image3', 'image4', 'image5',
                    'status', 'created_at'
                ])->get();
            }])
            ->get();

        $collection = collect(['cart' => $cart]);

        if (!$cart->isEmpty()) {
            $cartTotalPrice = 0.00;

            foreach ($cart as $value) {
                $cartTotalPrice += $value->total_price;
            }
            $collection->put('cart_total_price', sprintf('%.2f', round($cartTotalPrice, 2)) );
        }

        return $this->response->array(['message' => 'success', 'data' => $collection]);
    }

}
