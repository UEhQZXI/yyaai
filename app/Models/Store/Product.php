<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'app_store_products';
    protected $fillable = ["id","category_id", "title", "description", "model", "original_price", "current_price", "inventory", "status", "group_number", "image1", "image2", "image3", "image4", "image5", "numbering"];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
