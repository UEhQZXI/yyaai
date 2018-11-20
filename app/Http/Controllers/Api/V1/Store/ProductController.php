<?php

namespace App\Http\Controllers\Api\V1\Store;

use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Store\ProductRequest;
use App\Models\Store\Product;
use App\Transformers\ProductTransformer;
use Dingo\Api\Http\Request;

class ProductController extends Controller
{
    /**
     * 新增商品
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return mixed
     */
    public function store(ProductRequest $request, Product $product)
    {
        $product->fill($request->all());
        $product->group_number = uniqid();
        $product->save();

        // return $this->response->item($product, new ProductTransformer())
        //     ->setStatusCode(201);
        return $this->response->array(['message' => 'success', 'data' => []]);
    }

    /**
     * 删除商品
     *
     * @param $product
     * @return mixed
     */
    public function destroy($product)
    {
        Product::where('id', $product)->delete();

        // return $this->response()->noContent();
        return $this->response->array(['message' => 'success', 'data' => []]);
    }

    /**
     * 更新商品
     *
     * @param ProductRequest $request
     * @param $product
     * @return mixed
     */
    public function update(ProductRequest $request, $product)
    {
        if ($request->has('fileuploader-list-file')) {
            unset($request['fileuploader-list-file']);
        }
        Product::where('id', $product)
            ->update($request->all());

        return $this->response->array(['message' => 'success', 'data' => []]);
    }

    /**
     * 查询所有商品
     *
     * @param Request $request
     * @param Product $product
     * @return mixed
     */
    public function index(Request $request, Product $product)
    {
        if ($request->has('key')) {
            $data = Product::search($request->key)->paginate(10);
            return $this->response->array(['message' => 'success', 'data' => $data]);
        }

        $query = $product->query();

        if ($category_id = $request->category_id) {
            $query->where('category_id', $category_id);
        }

        $request->has('total') ? $products = $query->get() : $products = $query->paginate(10);

        return $this->response->array(['message' => 'success', 'data' => $products]);
    }

    /**
     * 查询单个商品信息
     *
     * @param $product
     */
    public function productIndex(Request $request, $product)
    {
        $product = Product::where('id', $product)->first();

        if (!$product) {
            return $this->response->error('商品过期不存在', 422);
        }

        if (!$product->status) {
            return $this->response->error('商品已下架', 422);
        }

        if ($request->has('product_number')) {

            $productNumber = round($request->product_number);

            $products = Product::select(['id', 'category_id', 'title', 'description', 'model', 'original_price', 'current_price', 'inventory', 'group_number', 'image1', 'image2', 'image3', 'image4', 'image5', 'status', 'created_at'])
                ->where('id', $product->id)
                ->first();

            if ($products->inventory < $productNumber) {
                return $this->response->error('商品库存不足', 422);
            }

            $collection = collect(['product' => $products]);

            $total_price = $products->current_price * $productNumber;

            $collection->put('number', $productNumber);
            $collection->put('total_price', sprintf('%.2f', round($total_price, 2)) );

            return $this->response->array(['message' => 'success', 'data' => $collection]);
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

    /**
     * 为您推荐板块
     *
     * @return mixed
     */
    public function userExclusive(Request $request)
    {
        $products = Product::select(['id', 'title', 'description', 'original_price', 'current_price', 'image1', 'group_number'])
            ->where('status', 1)
            ->get();

        $groupNumber = "0";
        foreach ($products as $key => $value) {

            if ($value->group_number == $groupNumber) {
                $products->forget($key);
            } else {
                $groupNumber = $value->group_number;
            }
        }

        if (sizeof($products) > 10) {
            $products = $products->random(10);
        }

        if ($request->has('today')) {
            $products = $products->random(5);
        }

        $products = $products->shuffle();

        return $this->response->array(['message' => 'success', 'data' => $products]);
    }
}
