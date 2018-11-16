<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Action;

class LoginController extends Controller
{
    public function view()
    {
    	return view('admin.login.login');
    }

    public function login(Request $request)
    {
    	$info = Admin::where('username', $request->username)->where('password', md5($request->password))->first();

    	if ($info) {
    		session(['info' => json_encode($info)]);
    		$actions = Action::where('role', $info->role)->with(['role'])->get();
    		session(['role' => json_encode($actions)]);
            session(['time' => date('Y-m-d H:i:s')]);
    		return $this->response->array(['message' => '登陆成功', 'data' => ['info' => $info], 'status_code' => 200]);
    	} else {
    		return $this->response->array(['message' => '账号或密码错误', 'data' => [], 'status_code' => 401]);
    	}
    }

    public function logout()
    {
        session(['info' => false, 'role' => false]);
    }
}
