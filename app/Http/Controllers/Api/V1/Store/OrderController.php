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
use App\Models\Store\Product;
use App\Models\Store\Cart;


class OrderController extends Controller
{
    public function store(OrderRequest $request)
    {
    	$data = $request->only(['address_id']);
    	$data['order_number'] = 'yy' . $_SERVER['REQUEST_TIME'] . uniqid();
        $data['user_id'] = $this->user()->id;
        $data['created_time'] = $data['updated_time'] = date('Y-m-d H:i:s');
        $data['status'] = $data['sum_price'] = 0;

        switch ($request->type ) {
            case 'direct':
                //直接购买（商品id、商品数量）
                $pro = Product::find($request->product_id);
                $data['sum_price'] = $request->num * $pro->current_price;
                break;
            
            default:
                //通过购物车购买
                $cart_ids = explode(',', $request->cart_ids);
                $carts = array();
                foreach ($cart_ids as $val) {
                    $carts[] = $cart = Cart::find($val);
                    $data['sum_price'] += $cart->total_price;
                }
                break;
        }

    	try {
            DB::beginTransaction();
           	Order::insert($data);

           	if ($request->type == 'direct') {
                OrderNumber::insert([
                    'order_number' => $data['order_number'],
                    'products_id' => $pro->id,
                    'num' => $request->num,
                    'price' => $pro->current_price
                ]);

            } else {
                foreach ($carts as $v) {
                    $product = Product::find($v->product_id);

                    OrderNumber::insert([
                        'order_number' => $data['order_number'],
                        'products_id' => $v->product_id,
                        'num' => $v->product_number,
                        'price' => $product->current_price
                    ]);
                    //订单添加成功后，删除（自己）购物车
                    Cart::where('id', $v->id)->where('user_id', $this->user()->id)->delete();
                }
            }
            
            DB::commit();
            return $this->response->array(['message' => '添加成功', 'data' => []]);

        } catch (Exception $e) {
            DB::rollback();
            return $this->response->array(['message' => '添加订单失败，请重试', 'data' => []]);
        }
    }

    public function update(OrderRequest $request, $order)
    {
    	$data = $request->all();
    	$data['updated_time'] = date('Y-m-d H:i:s');
    	Order::where('id', $order)->update($data);

    	return $this->response->array(['message' => '修改成功', 'data' => []]);
    }

    public function index(Request $request)
    {
    	$query = Order::query();

        $request->has('status')
                                ? $query->where('status', $request->status)
                                : '';

        $orders = $query->with(['orderInfo', 'orderInfo.product'])->paginate(10);

        return $this->response->array(['message' => 'success', 'data' => $orders]);
    }

    public function userIndex(User $user, Request $request)
    {
        $query = Order::query();

        $request->has('status')
                                ? $query->where('status', $request->status)
                                : '';
        $data = $query->where('user_id', $this->user()->id)->with(['orderInfo', 'address', 'orderInfo.product'])->paginate(10);

        return $this->response->array(['message' => 'success', 'data' => $data]);
    }

    public function show($order)
    {
        $data = Order::with(['orderInfo', 'address', 'orderInfo.product'])->find($order);

        return $this->response->array(['message' => 'success', 'data' => $data]);
    }
}
