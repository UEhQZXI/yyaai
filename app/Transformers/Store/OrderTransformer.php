<?php

namespace App\Transformers\Store;

use League\Fractal\TransformerAbstract;
use App\Models\Store\Order;
use App\Models\Store\OrderNumber;


class OrderTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['orderNumber', 'user'];

    public function transform(Order $order)
    {
            return [
               'id' => $order->id,
               'order_number' => $order->order_number,
               'user_id' => $order->user_id,
               'pay_time' => $order->pay_time,
               'address_id' => $order->address_id,
               'status' => $order->status,
               'pay_type' => $order->pay_type,
               'created_time' => $order->created_time,
               'updated_time' => $order->updated_time,
               'sum_price' => $order->sum_price
            ];
    }

    public function includeOrderNumber(Order $order)
    {
        return $this->item($order->orderNumber, new OrderNumberTransformer());
    }

    public function includeArticleClassify(Article $article)
    {
        return $this->item($article->articleClassify, new CategoryTransformer());
    }
}