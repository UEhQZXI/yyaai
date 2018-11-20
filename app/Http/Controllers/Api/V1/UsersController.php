<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\UserRequest;
use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * 用户注册
     *
     * @param UserRequest $request
     * @return $this|void
     */
    public function store(UserRequest $request)
    {
        $verifyData = \Cache::get($request->verification_key);

        if (!$verifyData) {
            return $this->response->error('验证码已失效', 422);
        }

        if (!hash_equals($verifyData['code'], $request->verification_code)) {
            return $this->response->errorUnauthorized('验证码错误');
        }

        // 是否是绑定手机号码的操作
        if ($request->filled('action')) {
            // 先判断当前手机号码是否被绑定过QQ
            $socialId = User::select('qq_id')->where('phone', $verifyData['phone'])->first();

            // 没有绑定过qq，
            if (!$socialId || !$socialId->qq_id) {

                $user = User::updateOrCreate([
                    'phone' => $verifyData['phone'],
                    'name' => $request->name,
                    'avatar' => $request->avatar,
                    'qq_id' => $request->qqId
                ]);
            } else {
                return $this->response->error('该手机号码已绑定其他账号', 422);
            }

        } else {

            // 生成随机用户名
            $name = '牙牙_'.str_random(1).mt_rand(1, 99).str_random(4);

            $user = User::create([
                'name' => $name,
                'phone' => $verifyData['phone'],
                'password' => bcrypt($request->password),
                'create_time' => time(),
            ]);
        }

        // 清除验证码缓存
        \Cache::forget($request->verification_key);

        return $this->response->array(['message' => 'success', 'data' => [
            'access_token' => \Auth::guard('api')->fromUser($user),
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
        ]]);
    }

    /**
     * 查询个人信息
     *
     * @return \Dingo\Api\Http\Response
     */
    public function me()
    {
//        return $this->user();
        $user = User::select(['id', 'name', 'avatar', 'sex', 'birthday', 'address', 'description', 'integral', 'fans', 'created_at', 'updated_at'])->where('id', $this->user()->id)->get();

        return $this->response->array(['message' => 'success', 'data' => $user]);
    }

    /**
     * 更新信息
     *
     * @param UserRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function update(UserRequest $request)
    {
        $user = $this->user();

        $data = $request->only(['name','avatar','sex','birthday','address','description']);

        $user->update($data);

        return $this->response->array(['message' => 'success', 'data' => []]);

//        return $this->response->item($user, new UserTransformer());
    }
}
