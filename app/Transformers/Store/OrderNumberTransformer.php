<?php

namespace App\Transformers\Store;

use League\Fractal\TransformerAbstract;
use App\Models\Store\Order;
use App\Models\Store\OrderNumber;


class OrderNumberTransformer extends TransformerAbstract
{
    protected $availableIncludes = [];

    public function transform(OrderNumber $orderNumber)
    {
            return [
               'id' => $orderNumber->id,
               'order_number' => $orderNumber->order_number,
               'products_id' => $orderNumber->products_id,
               'num' => $orderNumber->num,
               'price' => $orderNumber->price
            ];
    }

    public function includeOrdereNumber(Order $order)
    {
        return $this->item($order->orderNumber, new OrderNumberTransformer());
    }

    public function includeArticleClassify(Article $article)
    {
        return $this->item($article->articleClassify, new CategoryTransformer());
    }
}