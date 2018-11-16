<?php

namespace App\Http\Controllers\Api\V1\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class WeiboLoginController extends Controller
{
    public function index()
    {
    	return Socialite::with('Weibo')->redirect();
    }

    public function notify(Request $request)
    {
    	return $request->all();
    }
}
