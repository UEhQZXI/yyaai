<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\UploadRequest;
use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use Helpers;

    private $upload_host;

    public function __construct()
    {
        $this->upload_host = env('APP_URL');
    }

    //文件上传
    public function upload(UploadRequest $request)
    {
        if ($request->hasFile('file') && $request->file('file')[0]->isValid()) {
            $photo = $request->file('file')[0];
            $extension = $photo->extension();
            $dir = 'images';
            $filename = time() . uniqid() . '.' . $extension;
            $store_result = $photo->storeAs($dir, $filename, 'upload');
            $path = env('APP_URL') . $dir . '/' . $filename;
            return $this->response->array(['message' => '上传成功', 'data' => ['path' => $path]]);
        }
        exit('未获取到上传文件或上传过程出错');
    }
}