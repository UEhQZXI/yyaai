<?php

namespace App\Http\Controllers\Api\V1\Store;

use App\Models\Store\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\Controller;
use Pay;

class AliPayController extends Controller
{
    /***
     * 订单支付
     *
     * @param $order 订单编号
     */
    public function store($order)
    {
        $order = Order::select(['user_id','order_number', 'sum_price', 'status'])->where('order_number', $order)->first();

        // 判断订单状态
        if (!$order || in_array($order->status, [1, 2, 3, 4, 5])) {
            return $this->response->error('订单参数异常，请重新下单后再发起付款', 422);
        }

        // 判断订单是不是当前用户提交的
        if ($order->user_id != $this->user()->id) {
            return $this->response->error('This action is unauthorized.', 403);
        }

        // 调用支付宝手机网站支付
        $order = [
            'out_trade_no' => $order->order_number,
            'total_amount' => $order->sum_price,
            'subject' => env('APP_STORE_NAME', ''),
        ];

        return Pay::alipay()->wap($order);
    }

    // 支付宝回调
    public function notify()
    {
        $alipay = Pay::alipay();

        try {
            $data = $alipay->verify();// 校验输入参数

            // 拿到订单流水号，并在数据库中查询订单信息
            $order = Order::where('order_number', $data->out_trade_no)->first();

            // 应该不可能会支付一个不存在的订单，这里就保险判断一下
            if (!$order) {
                return 'fail';
            }

            // 判断订单是不是已经支付
            if ($order->ali_pay) {

                // 已经支付回调给支付宝
                return $alipay->success();
            }

            if ($data->trade_status == 'TRADE_SUCCESS'
                || $data->trade_status == 'TRADE_FINISHED')
            {
                Order::where('order_number', $data->out_trade_no)
                    ->update([
                        'status' => 1,
                        'ali_pay' => 1,
                        'pay_type' => 1,
                        'updated_time' => Carbon::now(),
                        'pay_time' => Carbon::now(),
                        'ali_trade_no' => $data->trade_no,
                        'ali_buyer_id' => $data->buyer_id,
                        'ali_buyer_logon_id' => $data->buyer_logon_id,
                        'ali_total_amount' => $data->total_amount,
                        'ali_gmt_create' => $data->gmt_create,
                        'ali_gmt_payment' => $data->gmt_payment,
                    ]);
            }

        } catch (Exception $e) {
            // 以后记录错误日志
        }

        return $alipay->success();
    }

    // 前端回调页面
    public function aliReturn()
    {
        echo '支付成功';
    }
}
