<?php
namespace App\Transformers;

use App\Models\Store\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'category_id' => $product->category_id,
            'title' => $product->title,
            'description' => $product->description,
            'model' => $product->model,
            'original_price' => $product->original_price,
            'current_price' => $product->current_price,
            'inventory' => $product->inventory,
            'status' => $product->status,
            'group_number' => $product->group_number,
            'image1' => $product->image1,
            'image2' => $product->image2,
            'image3' => $product->image3,
            'image4' => $product->image4,
            'image5' => $product->image5,
            'created_at' => $product->created_at,
            'updated_at' => $product->updated_at
        ];
    }
}
