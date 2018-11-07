<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminRequest;
use App\Http\Controllers\Api\V1\Controller;
use App\Models\Admin\Admin;

class AdminController extends Controller
{
	public function indexview()
	{
		$data = Admin::all();
		$admin_num = count($data->toArray());

		return view('admin.user.index')->with(
			[
				'data' => $data,
				'role' => array('超级管理员', '普通管理员', '操作编辑管理员'),
				'sex' => array('女', '男', '保密'),
				'status' => array('禁用', '启用'),
				'admin_num' => $admin_num
			]
		);
	}

    public function store(AdminRequest $request, Admin $admin)
    {
    	$data = $admin->fill($request->except(['password']));
    	$admin->create_time = $admin->login_time = date('Y-m-d H:i:s');
    	$admin->login_ip = $_SERVER['REMOTE_ADDR'];
    	$admin->password = encrypt($request->password);
    	$admin->save();

    	return $this->response->array(['message' => '添加管理员成功', 'data' => []]);
    }

    public function updateview($admin_id)
    {
    	$info = Admin::find($admin_id);
    	$a = $b = $c = '';
    	switch ($info->role) {
    		case 0:
    			$a = 'selected';
    			break;
    		
    		case 1:
    			$b = 'selected';
    			break;

    		default:
    			$c = 'selected';
    			break;
    	}
    	return view('admin.user.update')->with(
    		[
    			'info' => $info,
    			'a' => $a,
    			'b' => $b,
    			'c' => $c
    		]
    	);
    }

    public function update(AdminRequest $request, $admin_id)
    {
    	$admin = Admin::find($admin_id);

    	if ($request->has('status')) {
    		$admin->status = abs($admin->status - 1);
    	} else {
    		$admin->role = $request->role;
    	}

    	$admin->save();

    	return $this->response->array(['message' => '修改成功', 'data' => []]);
    }

    public function destroy(AdminRequest $request)
    {
    	if (is_array($request->admin_id)) {
    		// 批量删除
    		Admin::whereIn('id', $request->admin_id)->delete();
    	} else {
    		// 删除单个
    		Admin::destroy($request->admin_id);
    	}

    	return $this->response->array(['message' => '删除成功', 'data' => []]);
    }
}
