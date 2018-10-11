<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\UploadRequest;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use Helpers;

    //文件上传
    public function upload(UploadRequest $request)
    {
    	$path = $request->file->store($request->type);

    	return $path;
    }
}