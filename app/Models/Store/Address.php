<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'app_store_address';
    public $timestamps = false;

    public function order()
    {
    	return $this->belongsTo('App\Models\Store\Order', 'id');
    }
}
