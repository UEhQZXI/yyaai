<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Role;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Action;

class RoleController extends MiddleController
{
    public function indexview()
    {
    	$data = Admin::all();
    	$data0 = $data1 = $data2 = array(0);

    	foreach ($data as $val) {
    		if ($val->role == 0) {
    			$data0[0] += 1;
    			$data0[] = $val;
    		} else if ($val->role == 1) {
    			$data1[0] += 1;
    			$data1[] = $val;
    		} else {
    			$data2[0] += 1;
    			$data2[] = $val;
    		}
    	}

    	return view('admin.role.index')->with(
    		[
    			'data0' => $data0,
    			'data1' => $data1,
    			'data2' => $data2
    		]
    	);
    }

    public function store(Request $request, Role $role)
    {
    	try {
    		DB::beginTransaction();
	    	Role::insert(
	    		[
	    			'name' => $request->name,
	    			'route' => $request->route,
	    			'description' => $request->description,
	    			'categories' => $request->categories,
	    			'type' => $request->type
	    		]
	    	);
    		DB::commit();
    		return $this->response->array(['message' => '添加成功', 'data' => []]);
    	} catch (Exception $e) {
    		DB::rollback();
    		return $e->getMessage();
    	}
    }

    public function updateview($role_id)
    {
    	$data = Role::get()->toArray();
    	$dat['store'] = $dat['order'] = $dat['admin'] = $dat['categories'] = $dat['user'] = $dat['role'] = array();
    	$actions = Action::where('role', $role_id)->get(['action_id'])->toArray();
    	$actions = $this->twoToOne($actions, 'action_id');

    	foreach ($data as $key => $value) {
    		switch ($value['categories']) {
    			case 'store':
    				$dat['store'][] = $value;
    				break;
    			
    			case 'order':
    				$dat['order'][] = $value;
    				break;

    			case 'admin':
    				$dat['admin'][] = $value;
    				break;

    			case 'categories':
    				$dat['categories'][] = $value;
    				break;

    			case 'user':
    				$dat['user'][] = $value;
    				break;

    			case 'role':
    				$dat['role'][] = $value;
    				break;
    		}
    	}
    	// dd($dat);
    	$info = Admin::where('role', $role_id)->get();
    	$admin = ['超级管理员', '普通管理员', '编辑管理员'];

    	return view('admin.role.update')->with(
    		[
    			'data' => $data,
    			'info' => $info,
    			'admin' => $admin,
    			'role_id' => $role_id,
    			'dat' => $dat,
    			'actions' => $actions
    		]
    	);
    }

    public function update(Request $request)
    {
    	try {
    		DB::beginTransaction();
            Action::where('role', $request->role)->delete();
            if ($request->role_id) {
                foreach ($request->role_id as $val) {
                    Action::insert([
                        'role' => $request->role,
                        'action_id' => $val
                    ]);
                }
            }
    		DB::commit();
    		return $this->response->array(['message' => '添加成功', 'data' => []]);
    	} catch (Exception $e) {
    		DB::rollback();
    		return $e->getMessage();
    	}
    }

    private function twoToOne($arr, $key) 
    {
    	$result = [];

    	foreach ($arr as $val) {
    		$result[] = $val[$key];
    	}

    	return $result;
    }
}
