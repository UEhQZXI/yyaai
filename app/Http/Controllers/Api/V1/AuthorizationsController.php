<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\AuthorizationRequest;
use App\Models\User;

class AuthorizationsController extends Controller
{
    /***
     * 账号密码和短信验证码登录
     *
     * @param AuthorizationRequest $request
     * @return array $token
     */
    public function store(AuthorizationRequest $request)
    {
        if ($request->has('action') && $request->action == 'phoneLogin') {
            $verifyData = \Cache::get($request->verification_key);

            if (!$verifyData) {
                return $this->response->error('验证码已失效', 422);
            }

            if (!hash_equals($verifyData['login_code'], $request->verification_code)) {
                return $this->response->errorUnauthorized('验证码错误');
            }

            $info = User::where('phone', $request->phone)->first();

            if (!$info) {
                // 生成随机用户名
                $name = '牙牙_'.str_random(1).mt_rand(1, 99).str_random(4);

                $user = User::create([
                    'name' => $name,
                    'phone' => $verifyData['phone'],
                    'password' => bcrypt(''),
                    'create_time' => time(),
                ]);
            } 
            // 清除验证码缓存
            \Cache::forget($request->verification_key);
            
            $token = \Auth::guard('api')->fromUser($info);
        } else {

            $loginInfo['phone'] = $request->phone;
            $loginInfo['password'] = $request->password;

            if (!$token = \Auth::guard('api')->attempt($loginInfo)) {
                return $this->response->errorUnauthorized('账号或密码错误');
            }
        }

        return $this->response->array(['message' => 'success','data' => [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
        ]]);
    }

    public function socialStore($type)
    {

    }
}