<?php

namespace App\Http\Controllers\Api\V1\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class WeiboLoginController extends Controller
{
    public function index()
    {
        return Socialite::with('weibo')->redirect();
    }

    public function notify(Request $request)
    {
        $data = Socialite::driver('weibo')->user();
        $info = User::where('weibo_id', $data->id)->first();

        if (!$info) {
            User::create([
                'name' => $data->nickname,
                'weibo_id' => $data->id,
                'avatar' => $data->avatar,
                'address' => $data->user['location'],
                'create_time' => time(),
            ]);
        }
    }
}
