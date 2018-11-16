<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Api\V1\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store\Product;
use App\Models\Store\Order;

class IndexController extends Controller
{
    public function index()
    {
    	$user_num = User::count();
    	$store_num = Product::count();
    	$order_num = Order::count();
    	$price_sum = Order::where('status', 3)->sum('sum_price');
    	$ip = $_SERVER['REMOTE_ADDR'];
    	
    	return view('admin.index')->with([
    		'user_num' => $user_num,
    		'store_num' => $store_num,
    		'order_num' => $order_num,
    		'price_sum' => $price_sum,
    		'ip' => $ip,
    	]);
    }
}
