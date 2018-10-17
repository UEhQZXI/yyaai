<?php

namespace App\Http\Controllers\Api\V1\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Api\V1\Store\OrderRequest;
use App\Models\Store\Order;
use Illuminate\Support\Facades\DB;
use App\Models\Store\OrderNumber;
use App\Transformers\Store\OrderTransformer;
use App\Models\User;

class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
    	$data = $request->only(['address_id']);
    	$data['order_number'] = 'yy' . $_SERVER['REQUEST_TIME'] . uniqid();
    	$product_ids = explode(',', $request->product_ids);
    	$price = explode(',', $request->price);
    	$num = explode(',', $request->num);
    	$len = count($price);
    	$leng = count($num);
    	$len_ids = count($product_ids);
    	$data['sum_price'] = 0;

    	if ($len !== $leng || $len !== $len_ids || $leng !== $len_ids)
    		return $this->failed('参数有误');

    	for ($i = 0; $i < $len; $i++) {
    		$data['sum_price'] += $price[$i] * $num[$i];
    	}

    	$data['user_id'] = $this->user()->id;
    	$data['status'] = 0;
    	$data['created_time'] = $data['updated_time'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);

    	try {
            DB::beginTransaction();
           	Order::insert($data);

           	for ($j = 0; $j < $len; $j++) {
           		OrderNumber::insert([
           			'order_number' => $data['order_number'],
           			'products_id' => $product_ids[$j],
           			'num' => $num[$j],
           			'price' => $price[$j]
           		]);
           	}
            DB::commit();
            return $this->response->noContent();
        } catch (Exception $e) {
            DB::rollback();
            return $this->response->noContent();
        }
    }

    public function update(OrderRequest $request, $order)
    {
    	$data = $request->all();
    	$data['updated_time'] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
    	Order::where('id', $order)->update($data);

    	return $this->response->noContent();
    }

    public function index(Request $request)
    {
    	$query = Order::query();

        $request->has('status')
                                ? $query->where('status', $request->status)
                                : '';

        $orders = $query->with('orderNumber')->paginate(10);

        return $this->response->array($orders, new OrderTransformer());
    }

    public function userIndex(User $user, Request $request)
    {
        $data = Order::where('user_id', $this->user()->id)->with(['orderNumber'])->paginate(10);

        return $this->response->array($data);
    }

    public function show($order)
    {
        $data = Order::with(['orderNumber'])->find($order);

        return $this->response->array($data);
    }
}
