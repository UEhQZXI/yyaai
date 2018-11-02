<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\UploadRequest;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use Helpers;

    private $upload_host = 'http://m.iyaa180.com/uploads/';
    //文件上传
    public function upload(UploadRequest $request)
    {
    	$path = $request->file->store($request->type);

    	return $this->response->array(['message' => 'success', 'data' => ['path' => $this->upload_host . $path]]);
    }
}