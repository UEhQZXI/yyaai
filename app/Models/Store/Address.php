<?php

namespace App\Models\Store;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'app_store_address';
    protected $fillable = ['id', 'user_name', 'user_phone', 'user_tel', 'area1', 'area2', 'area3', 'address', 'is_default', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


