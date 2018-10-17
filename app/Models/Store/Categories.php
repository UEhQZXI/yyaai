<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
	protected $fillable = ['name', 'pid'];
    protected $table = 'app_store_categories';
    public $timestamps = false;
}
