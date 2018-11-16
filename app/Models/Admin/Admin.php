<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'app_admins';
    public $timestamps = false;
    protected $fillable = ['username', 'password', 'email', 'sex', 'phone', 'role', 'description'];
}
