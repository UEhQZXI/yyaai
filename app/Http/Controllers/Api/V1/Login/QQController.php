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

        // 没有用户，先让用户绑定手机号码进行判断
        if (!$user)
            return view('wap.login.bindPhone')
                ->with([
                    'qqId' => $qqUser->id,
                    'name' => $qqUser->nickname,
                    'avatar' => $qqUser->avatar
                ]);


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
