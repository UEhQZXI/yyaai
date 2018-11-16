<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\User;

class UserController extends MiddleController
{
    public function indexview()
    {
    	$data = User::get();
    	$sex = ['女', '男'];

    	return view('admin.customer.index')->with(
    		[
    			'data' => $data,
    			'sex' => $sex
    		]
    	);
    }

    public function info(Request $request)
    {
    	$info = User::find($request->id);

    	return $info;
    }
}
