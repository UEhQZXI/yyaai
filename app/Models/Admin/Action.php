<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table = 'app_role';
    public $timestamps = false;

    public function role()
    {
    	return $this->hasOne('App\Models\Admin\Role', 'id', 'action_id');
    }
}
