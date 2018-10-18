<?php

namespace App\Http\Controllers\Api\V1\Store;

use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Store\ProductRequest;
use App\Models\Store\Product;
use App\Transformers\ProductTransformer;
use Dingo\Api\Http\Request;

class ProductController extends Controller
{
    public function store(ProductRequest $request, Product $product)
    {
        $product->fill($request->all());
        $product->group_number = uniqid();
        $product->save();

        // return $this->response->item($product, new ProductTransformer())
        //     ->setStatusCode(201);
        return $this->response->array(['message' => 'success', 'data' => []]);
    }

    public function destroy($product)
    {
        Product::where('id', $product)->delete();

        // return $this->response()->noContent();
        return $this->response->array(['message' => 'success', 'data' => []]);
    }

    public function update(ProductRequest $request, $product)
    {
        Product::where('id', $product)
            ->update($request->all());

        return $this->response->array(['message' => 'success', 'data' => []]);
    }

    public function index(Request $request, Product $product)
    {
        $query = $product->query();

        if ($category_id = $request->category_id) {
            $query->where('category_id', $category_id);
        }

        $products = $query->paginate(2);

        // return $this->response->paginator($products, new ProductTransformer());
        return $this->response->array(['message' => 'success', 'data' => $products]);
    }

    public function productIndex($product)
    {
        $product = Product::where('id', $product)->first();

        if (empty($product)) {
            return $this->response->error('商品过期不存在', 422);
        }

        if (!$product->status) {
            return $this->response->error('商品已下架', 422);
        }

        if ($product->group_number) {
            $product->linked = Product::where('group_number', $product->group_number)->get();

            foreach ($product->linked as $item => $value) {
                if ($value->id == $product->id || $value->status == 0) {
                    $product->linked->pull($item);
                }
            }

            $product->linked = $product->linked->values()->all();
        }

        return $this->response->array(['message' => 'success', 'data' => $product]);
    }

    public function userExclusive()
    {
        $products = Product::select(['id', 'title', 'description', 'original_price', 'current_price'])->get();

        $products = $products->random(10);

        return $this->response->array(['message' => 'success', 'data' => $products]);
    }
}
