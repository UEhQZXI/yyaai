<?php

namespace App\Http\Controllers\Api\V1\Login;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\Controller;
use Laravel\Socialite\Facades\Socialite;

class QQController extends Controller
{

    public function index()
    {
        return Socialite::with('qq')->redirect();
    }

    public function notify()
    {
        $qqUser = Socialite::driver('qq')->user();
        $qqId = $qqUser->id;

        $user = User::where('qq_id', $qqId)->first();

        // 没有用户创建一个用户
        if (!$user) {
            $user = User::create([
                'name' => $qqUser->nickname,
                'avatar' => $qqUser->avatar,
            ]);
        }

        // 没有绑定手机号先绑定手机号码
        if (!$user->phone) {

            // 获取token
            $token = \Auth::guard('api')->fromUser($user);

            // 返回到绑定手机号页面
            return view('wap.login.bindPhone')->with('token', $token);
        }

        // 绑定手机后直接返回token
        $token = \Auth::guard('api')->fromUser($user);

        // token写入本地缓存
        $this->localStorage('token', $token);
        $this->localStorage('name', $user->name ?? $user->phone);

        return view('wap.my.index');
    }

    private function localStorage($key, $value)
    {
        echo "<script>
            localStorage.setItem('". $key ."', '". $value ."')
        </script>";
    }
}
