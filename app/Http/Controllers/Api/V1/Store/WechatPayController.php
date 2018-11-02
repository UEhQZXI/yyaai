<?php

namespace App\Http\Controllers\Api\V1\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\Controller;
use Yansongda\Pay\Pay;
use Yansongda\Pay\Log;
use App\Models\Store\Order;

class WechatPayController extends Controller
{
    protected $config = [
        'appid' => 'wx81885922a85a8519',
        // 'app_id' => 'xxxxxxxxxxxxxxxx',
        // 'miniapp_id' => 'xxxxxxxxxxxxxxx',
        'mch_id' => '1490055842',
        'key' => '5fc206f0c6363cc537135a7c978bb962',
        'notify_url' => 'http://47.100.3.125/api/wechatpay/success',
        'cert_client' => './apiclient_cert.pem', 
        'cert_key' => './apiclient_key.pem',
        'log' => [ 
            'file' => './logs/wechat.log',
            'level' => 'debug', // 建议生产环境等级调整为 info，开发环境为 debug
            'type' => 'single', // optional, 可选 daily.
            'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
        ],
        'http' => [ // optional
            'timeout' => 5.0,
            'connect_timeout' => 5.0,
        ],
    ];

    protected $wechat = NULL;

    public function __construct()
    {
        $this->wechat = Pay::wechat($this->config);
    }

    public function index(Request $request)
    {
        $info = Order::find($request->order_id);

        // if ($info->user_id != $this->user()->id)
        //  return $this->array(['message' => '别乱付款', 'data' => []]);

        $order = [
            'out_trade_no' => $info->order_number,
            'body' => '医牙啊-商品购买',
            'total_fee' => $info->sum_price * 100
        ];

        // 判断是app商城还是手机网站商城
        if ($request->has('pay_device') && $request->pay_device == 'wap') {
            $data = $this->wechat->wap($order);
        } else {
            $data = $this->wechat->app($order);
        }
        
        \QrCode::format('png')->generate('asda', public_path('qrcode.png'));
    }

    public function refund(Request $request)
    {
        $info = Order::find($request->order_id);

        if ($info->user_id != $this->user()->id)
            return $this->array(['message' => '别乱退款', 'data' => []]);

        $order = [
            'type' => 'app',
            'out_trade_no' => $info->order_number,
            'out_refund_no' => time(),
            'total_fee' => $info->sum_price * 100,
            'refund_fee' => $request->input('refund_fee') ?: $info->sum_price * 100,
            'refund_desc' => $request->input('refund_desc') ?: '',
        ];

        $result = $wechat->refund($order);
        var_dump($result);
    }

    public function test()
    {
        \QrCode::format('png')->generate('asda', public_path('qrcode.png'));
    }

}
