<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'app_store_orders';
    public $timestamps = false;

    public function orderNumber()
    {
    	return $this->hasMany('App\Models\Store\OrderNumber', 'order_number', 'order_number');
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'user_id');
    }
}
