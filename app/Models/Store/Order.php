<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'app_store_orders';
    public $timestamps = false;

    public function orderInfo()
    {
    	return $this->hasMany('App\Models\Store\OrderNumber', 'order_number', 'order_number');
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getPayTypeAttribute($value)
    {
        return $value ?? '尚未支付';
    }

    public function getPayTimeAttribute($value)
    {
        return $value ?? '尚未支付';
    }

    public function address()
    {
        return $this->hasOne('App\Models\Store\Address', 'id', 'address_id');
    }
}
