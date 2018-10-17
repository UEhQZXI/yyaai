<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;

class OrderNumber extends Model
{
    protected $table = 'app_store_order_info';
    public $timestamps = false;

    public function order()
    {
    	return $this->belongsTo('App\Models\Store\Order', 'order_number', 'order_number');
    }
}
