<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatLoginController extends Controller
{
	private $appid = 'wx72ec50dfb4b26738';
	private $appscrit = '8a53dce39ce08c655d54359312835803';
    public function index()
    {
    	$uri = "https://open.weixin.qq.com/connect/qrconnect?appid=wx72ec50dfb4b26738&redirect_uri=http://m.iyaa180.com&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect";
    }
}
