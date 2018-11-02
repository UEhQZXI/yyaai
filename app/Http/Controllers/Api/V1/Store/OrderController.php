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
        'app_id' => 'wx81885922a85a8519',
        'mch_id' => '1490055842',
        'key' => '5fc206f0c6363cc537135a7c978bb962',
        'notify_url' => 'http://m.iyaa180.com/api/store/wechatpay/notify',
        'cert_client' => './apiclient_cert.pem',
        'cert_key' => './apiclient_key.pem',
        'log' => [
            'file' => './logs/wechat.log',
            'level' => 'info', //生产环境调整为 info，开发环境为 debug
            'type' => 'single',
            'max_file' => 30,
        ],
        'http' => [
            'timeout' => 5.0,
            'connect_timeout' => 5.0,
        ],
    ];

    protected $wechat = NULL;
    private $hostname = 'http://m.iyaa180.com/';

    public function __construct()
    {
        $this->wechat = Pay::wechat($this->config);
    }

    public function index(Request $request)
    {
        $info = Order::find($request->order_id);

        if ($info->user_id != $this->user()->id)
            return $this->array(['message' => 'error', 'data' => []]);

        $order = [
            'out_trade_no' => $info->order_number,
            'body' => '医牙啊-商品购买',
            'total_fee' => $info->sum_price * 100,
        ];

        if ($request->has('pay_device') && $request->pay_device == 'wap') {
            $data = $this->wechat->wap($order);
        } else if ($request->has('pay_device') && $request->pay_device == 'app') {
            $data = $this->wechat->app($order);
        } else {
            //扫码支付
            $data = $this->wechat->scan($order);

            $path = 'qrcode/' . $info->order_number . '.png';
            \QrCode::format('png')->size(200)->generate($data->code_url, public_path($path));

            return $this->response->array(['message' => 'success', 'data' => ['qrcode' => $this->hostname . $path]]);
        }
        dd($data);
    }

    
    public function notify(Request $request)
    {
        try{

            $data = $this->wechat->verify();
            file_put_contents('wechat.txt', $data . "\r\t\n", FILE_APPEND);

            $update_info = array(
                'status' => 1,
                'pay_type' => 0,
                'pay_time' => date('Y-m-d H:i:s'),
                'wechat_openid' => $data->openid,
                'wechat_time_end' => $data->time_end,
                'wechat_total_fee' => $data->total_fee / 100,
                'wechat_transaction_id' => $data->transaction_id
            );

            Order::where('order_number', $data->out_trade_no)->update($update_info);

        } catch (Exception $e) {

            file_put_contents('wechat.txt', '支付失败:' . "\r\t\n" . $e->getMessage());
        }
        
        return $pay->success()->send();
    }

    public function test()
    {
        $result = $this->wechat->find('reefg4rpb0f');
        return ($result);
    }
    // object(Yansongda\Supports\Collection)#659 (1) {
    //   ["items":protected]=>
    //   array(20) {
    //     ["return_code"]=>
    //     string(7) "SUCCESS"
    //     ["return_msg"]=>
    //     string(2) "OK"
    //     ["appid"]=>
    //     string(18) "wx81885922a85a8519"
    //     ["mch_id"]=>
    //     string(10) "1490055842"
    //     ["nonce_str"]=>
    //     string(16) "G2UH3g0g3q1xJgj1"
    //     ["sign"]=>
    //     string(32) "E053445923ABDCA6570DB768E1A53F2E"
    //     ["result_code"]=>
    //     string(7) "SUCCESS"
    //     ["openid"]=>
    //     string(28) "oY5ht05EXHCVOYHFgqGKPSbFfCRA"
    //     ["is_subscribe"]=>
    //     string(1) "Y"
    //     ["trade_type"]=>
    //     string(6) "NATIVE"
    //     ["bank_type"]=>
    //     string(3) "CFT"
    //     ["total_fee"]=>
    //     string(1) "1"
    //     ["fee_type"]=>
    //     string(3) "CNY"
    //     ["transaction_id"]=>
    //     string(28) "4200000218201810313096678451"
    //     ["out_trade_no"]=>
    //     string(11) "reefg4rpb0f"
    //     ["attach"]=>
    //     array(0) {
    //     }
    //     ["time_end"]=>
    //     string(14) "20181031152442"
    //     ["trade_state"]=>
    //     string(7) "SUCCESS"
    //     ["cash_fee"]=>
    //     string(1) "1"
    //     ["trade_state_desc"]=>
    //     string(12) "支付成功"
    //   }
    // }
}
