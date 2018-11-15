<?php

namespace App\Http\Controllers\Admin;

use App\Models\Store\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends MiddleController
{
    public function index()
    {
        $query = Order::query();

        $orders = $query->with(['orderInfo', 'address', 'orderInfo.product'])->get();

        return view('admin.order.index')->with('orders', $orders);
    }

    public function update($order)
    {
        $data = Order::with(['orderInfo', 'address', 'orderInfo.product'])->find($order);

        return view('admin.order.update')->with('order', $data);
    }
}
