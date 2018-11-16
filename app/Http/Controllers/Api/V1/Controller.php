<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\UploadRequest;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use Helpers;

    private $route_fillable  = [
    	'api/store/product', // 添加商品
    	// 'api/store/orders',  // 查询订单
    ];

    public function __construct(Request $request)
    {
    	$route = $request->path();
    	if (in_array($route, $this->route_fillable)) {
    		if (!session('role') || !session('info'))
    			return redirect("/admin/login/view");

    		$role = json_decode(session('role'), true);
    		$roles = [];

    		foreach ($role as $key => $val) {
    			$roles[] = trim($val['role']['route'], '/');
    		}

    		if (!in_array($route, $roles)) {
    			die(json_encode(['message' => '你没有权限进行此操作', 'data' => [], 'status_code' => 10001]));
    		}
    	}
    }

    //文件上传
    public function upload(UploadRequest $request)
    {
    	if (is_array($request->file('file'))) {
    		if ($request->hasFile('file') && $request->file('file')[0]->isValid()) {
	        	$photo = $request->file('file')[0];
	        	$extension = $photo->extension();
	        	$dir = 'images';
	        	$filename = time() . uniqid() . '.' . $extension;
	        	$store_result = $photo->storeAs($dir, $filename, 'upload');
	        	$path = env('APP_URL_UPLOAD') . $dir . '/' . $filename;
	        	return $this->response->array(['message' => '上传成功', 'data' => ['path' => $path]]);
	    	}
    	} else {
    		if ($request->hasFile('file') && $request->file('file')->isValid()) {
    			$photo = $request->file('file');
    			$extension = $photo->extension();
	        	$dir = 'images';
	        	$filename = time() . uniqid() . '.' . $extension;
	        	$store_result = $photo->storeAs($dir, $filename, 'upload');
	        	$path = env('APP_URL_UPLOAD') . $dir . '/' . $filename;
	        	return $this->response->array(['message' => '上传成功', 'data' => ['path' => $path]]);
    		}
    	}
	    
	    exit('未获取到上传文件或上传过程出错');
    }
}