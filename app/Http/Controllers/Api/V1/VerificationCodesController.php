<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\VerificationCodeRequest;
use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request, EasySms $sms)
    {
        $phone = $request->phone;

        // 生成4位验证码
        $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);

        $info = ['phone' => $phone, 'code' => $code];
        $data = [
                    'code' => $code,
                    'product' => env('ALIYUN_SMS_PRODUCT')
                ];

        try {
            $template = 'SMS_4015599';
            if ($request->has('action') && $request->action == 'login') {
                $template = 'SMS_151045097';
                $info = ['phone' => $phone, 'login_code' => $code];
                $data = ['code' => $code];
            }

            $result = $sms->send($phone, [
                'template' => $template,
                'data' => $data
            ]);
        } catch (NoGatewayAvailableException $e) {
            $message = $e->getException('aliyun')->getMessage();
            return $this->response->error($message ?? '短信发送失败', 422);
        }

        $key = 'verificationCode_'.str_random(15);
        $expiredTime = now()->addMinute(10);
        // 缓存验证码，10分钟后过期
        \Cache::put($key, $info, $expiredTime);

        return $this->response->array([
            'message' => 'success',
            'data' => [
                'key' => $key,
                'expired_time' => $expiredTime->toDateTimeString()
            ]
        ]);
    }
}
