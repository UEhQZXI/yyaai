<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'app_action';
    public $timestamps = false;
    protected $fillable = ['role_id', 'name', 'route', 'description'];
}
