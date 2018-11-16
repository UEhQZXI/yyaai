<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\Controller;

class MiddleController extends Controller
{
	protected $fillable_route = array(
		'admin/role/updateview/*',
		'admin/user/updateview/*',
		'admin/user/update/*',
        'admin/orders/*/edit',
        'admin/products/*/edit'
	);

    public function __construct(Request $request)
    {
    	if (!session('role') || !session('info'))
    		return redirect("/admin/login/view");

    	$role = json_decode(session('role'), true);
    	$roles = [];

    	foreach ($role as $key => $val) {
    		$roles[] = trim($val['role']['route'], '/');
    	}

    	$route = $request->path();

    	if (!in_array($route, $roles)) {

    		foreach ($this->fillable_route as $val) {
    			if ($request->is($val)) {
    				return ;
    			}
    		}
    		
    		if ($request->ajax()) {
    			die(json_encode(['message' => '你没有权限进行此操作', 'data' => [], 'status_code' => 10001]));
    		} else {
    			// return redirect('/admin/norole');
                die(view('admin.role.role')); 
    		}
    	}
    }
}
