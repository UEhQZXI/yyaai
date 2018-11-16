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
    private $hostname = '';
    public function __construct()
    {
        $this->hostname = env("APP_URL", "");
        $this->config['app_id'] = env("WECHAT_APPID", "");
        $this->config['mch_id'] = env("WECHAT_MCH_ID", "");
        $this->config['key'] = env("WECHAT_KEY", "");
        $this->config['notify_url'] = env("WECHAT_NOTIFY", "");
        $this->config['return_url'] = 'http://m.iyaa180.com';
        $this->wechat = Pay::wechat($this->config);
    }
    public function index(Request $request)
    {
        $info = Order::where('order_number', $request->order_id)->first(); 
        // if ($info->user_id != $this->user()->id)
        //     return $this->array(['message' => 'error', 'data' => []]);
        $order = [
            'out_trade_no' => $info->order_number,
            'body' => '医牙啊-商品购买',
            'total_fee' => $info->sum_price * 100,
        ];
        if ($request->has('pay_device') && $request->pay_device == 'wap') {
            $data = $this->wechat->wap($order);
            return $data;
        } else if ($request->has('pay_device') && $request->pay_device == 'app') {
            $data = $this->wechat->app($order);
        } else {
            //扫码支付
            $data = $this->wechat->scan($order);
            $path = 'qrcode/' . $info->order_number . '.png';
            \QrCode::format('png')->size(200)->generate($data->code_url, public_path($path));
            return $this->response->array(['message' => 'success', 'data' => ['qrcode' => $this->hostname . $path]]);
        }
        // dd($data);
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
}